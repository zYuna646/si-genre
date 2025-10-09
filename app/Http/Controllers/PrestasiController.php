<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $anggota_id = $request->anggota_id;
        $anggota = Anggota::findOrFail($anggota_id);
        $prestasis = Prestasi::where('anggota_id', $anggota_id)->paginate(10);
        
        return view('master.prestasi.index', compact('prestasis', 'anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $anggota_id = $request->anggota_id;
        $anggota = Anggota::findOrFail($anggota_id);
        
        return view('master.prestasi.create', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis_kompetisi' => 'required|string|max:255',
            'prestasi' => 'required|string|max:255',
            'sertifikat' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'bukti_foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $data = $request->except('bukti_foto');
        
        // Handle multiple foto uploads
        if ($request->hasFile('bukti_foto')) {
            $bukti_foto = [];
            foreach ($request->file('bukti_foto') as $photo) {
                $path = $photo->store('prestasi/bukti', 'public');
                $bukti_foto[] = $path;
            }
            $data['bukti_foto'] = $bukti_foto;
        }
        
        Prestasi::create($data);
        
        return redirect()->route('master.prestasi.index', ['anggota_id' => $request->anggota_id])
            ->with('success', 'Prestasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        return view('master.prestasi.show', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        $anggota = $prestasi->anggota;
        return view('master.prestasi.edit', compact('prestasi', 'anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $request->validate([
            'jenis_kompetisi' => 'required|string|max:255',
            'prestasi' => 'required|string|max:255',
            'sertifikat' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'bukti_foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $data = $request->except(['bukti_foto', '_token', '_method']);
        
        // Handle multiple foto uploads
        if ($request->hasFile('bukti_foto')) {
            // Delete old photos if they exist
            if ($prestasi->bukti_foto) {
                foreach ($prestasi->bukti_foto as $oldPhoto) {
                    Storage::disk('public')->delete($oldPhoto);
                }
            }
            
            $bukti_foto = [];
            foreach ($request->file('bukti_foto') as $photo) {
                $path = $photo->store('prestasi/bukti', 'public');
                $bukti_foto[] = $path;
            }
            $data['bukti_foto'] = $bukti_foto;
        }
        
        $prestasi->update($data);
        
        return redirect()->route('master.prestasi.index', ['anggota_id' => $prestasi->anggota_id])
            ->with('success', 'Prestasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        $anggota_id = $prestasi->anggota_id;
        
        // Delete photos if they exist
        if ($prestasi->bukti_foto) {
            foreach ($prestasi->bukti_foto as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }
        
        $prestasi->delete();
        
        return redirect()->route('master.prestasi.index', ['anggota_id' => $anggota_id])
            ->with('success', 'Prestasi berhasil dihapus');
    }
}
