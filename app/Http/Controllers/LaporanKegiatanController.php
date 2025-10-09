<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\LaporanKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LaporanKegiatanController extends Controller
{
    /**
     * Verify the specified laporan kegiatan.
     */
    public function verify(string $id)
    {
        // Verifikasi hanya untuk admin
        if (Auth::user()->getRoleNames()[0] !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk memverifikasi laporan.');
        }
        
        $laporan = LaporanKegiatan::findOrFail($id);
        $laporan->isVerified = true;
        $laporan->save();
        
        return redirect()->back()->with('success', 'Laporan kegiatan berhasil diverifikasi.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = LaporanKegiatan::with('kegiatan')->paginate(10);
        return view('master.laporan.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $kegiatan_id = $request->kegiatan_id;
        $kegiatan = Kegiatan::findOrFail($kegiatan_id);
        
        // Cek apakah sudah ada laporan untuk kegiatan ini
        $existingLaporan = LaporanKegiatan::where('kegiatan_id', $kegiatan_id)->first();
        if ($existingLaporan) {
            return redirect()->route('master.laporan.edit', $existingLaporan->id)
                ->with('info', 'Laporan untuk kegiatan ini sudah ada. Silakan edit laporan yang ada.');
        }
        
        return view('master.laporan.create', compact('kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'jumlah_peserta' => 'required|integer|min:0',
            'ringkasan_kegiatan' => 'required|string',
            'daftar_hadir' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'dokumentasi_foto' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:10240',
            'dokumentasi_video' => 'nullable|file|mimes:mp4,mov,avi|max:51200',
            'surat_undangan' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'notulen_rapat' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'brosur_poster' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);
        
        $data = [
            'kegiatan_id' => $validated['kegiatan_id'],
            'jumlah_peserta' => $validated['jumlah_peserta'],
            'ringkasan_kegiatan' => $validated['ringkasan_kegiatan'],
        ];
        
        // Handle file uploads
        $fileFields = ['daftar_hadir', 'dokumentasi_foto', 'dokumentasi_video', 'surat_undangan', 'notulen_rapat', 'brosur_poster'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('laporan_kegiatan/' . $field, 'public');
                $data[$field] = $path;
            }
        }
        
        LaporanKegiatan::create($data);
        
        return redirect()->route('master.kegiatan.show', $validated['kegiatan_id'])
            ->with('success', 'Laporan kegiatan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laporan = LaporanKegiatan::with('kegiatan.pikr')->findOrFail($id);
        return view('master.laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporan = LaporanKegiatan::with('kegiatan')->findOrFail($id);
        $kegiatan = $laporan->kegiatan;
        return view('master.laporan.edit', compact('laporan', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $laporan = LaporanKegiatan::findOrFail($id);
        
        $validated = $request->validate([
            'jumlah_peserta' => 'required|integer|min:0',
            'ringkasan_kegiatan' => 'required|string',
            'daftar_hadir' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'dokumentasi_foto' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:10240',
            'dokumentasi_video' => 'nullable|file|mimes:mp4,mov,avi|max:51200',
            'surat_undangan' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'notulen_rapat' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'brosur_poster' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);
        
        $data = [
            'jumlah_peserta' => $validated['jumlah_peserta'],
            'ringkasan_kegiatan' => $validated['ringkasan_kegiatan'],
        ];
        
        // Handle file uploads
        $fileFields = ['daftar_hadir', 'dokumentasi_foto', 'dokumentasi_video', 'surat_undangan', 'notulen_rapat', 'brosur_poster'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama jika ada
                if ($laporan->$field) {
                    Storage::disk('public')->delete($laporan->$field);
                }
                
                $file = $request->file($field);
                $path = $file->store('laporan_kegiatan/' . $field, 'public');
                $data[$field] = $path;
            }
        }
        
        $laporan->update($data);
        
        return redirect()->route('master.kegiatan.show', $laporan->kegiatan_id)
            ->with('success', 'Laporan kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporan = LaporanKegiatan::findOrFail($id);
        $kegiatan_id = $laporan->kegiatan_id;
        
        // Hapus file-file terkait
        $fileFields = ['daftar_hadir', 'dokumentasi_foto', 'dokumentasi_video', 'surat_undangan', 'notulen_rapat', 'brosur_poster'];
        foreach ($fileFields as $field) {
            if ($laporan->$field) {
                Storage::disk('public')->delete($laporan->$field);
            }
        }
        
        $laporan->delete();
        
        return redirect()->route('master.kegiatan.show', $kegiatan_id)
            ->with('success', 'Laporan kegiatan berhasil dihapus.');
    }
}
