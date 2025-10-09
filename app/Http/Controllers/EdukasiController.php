<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use App\Models\KategoriEdukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EdukasiController extends Controller
{
    public function index()
    {
        $edukasi = Edukasi::with('kategori')->get();
        return view('admin.edukasi.index', compact('edukasi'));
    }

    public function create()
    {
        $kategori = KategoriEdukasi::all();
        return view('admin.edukasi.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,mp4,avi,mov,wmv|max:20480',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_edukasi_id' => 'required|exists:kategori_edukasi,id',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('edukasi/files', $fileName, 'public');

        $cover = $request->file('cover');
        $coverName = time() . '_' . $cover->getClientOriginalName();
        $coverPath = $cover->storeAs('edukasi/covers', $coverName, 'public');

        Edukasi::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'file' => $filePath,
            'cover' => $coverPath,
            'kategori_edukasi_id' => $request->kategori_edukasi_id,
        ]);

        return redirect()->route('master.edukasi.index')->with('success', 'Edukasi berhasil ditambahkan');
    }

    public function show(Edukasi $edukasi)
    {
        return view('admin.edukasi.show', compact('edukasi'));
    }

    public function edit(Edukasi $edukasi)
    {
        $kategori = KategoriEdukasi::all();
        return view('admin.edukasi.edit', compact('edukasi', 'kategori'));
    }

    public function update(Request $request, Edukasi $edukasi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,mp4,avi,mov,wmv|max:20480',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_edukasi_id' => 'required|exists:kategori_edukasi,id',
        ]);

        $data = [
            'name' => $request->name,
            'desc' => $request->desc,
            'kategori_edukasi_id' => $request->kategori_edukasi_id,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($edukasi->file) {
                Storage::disk('public')->delete($edukasi->file);
            }
            
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('edukasi/files', $fileName, 'public');
            $data['file'] = $filePath;
        }

        if ($request->hasFile('cover')) {
            // Hapus cover lama
            if ($edukasi->cover) {
                Storage::disk('public')->delete($edukasi->cover);
            }
            
            $cover = $request->file('cover');
            $coverName = time() . '_' . $cover->getClientOriginalName();
            $coverPath = $cover->storeAs('edukasi/covers', $coverName, 'public');
            $data['cover'] = $coverPath;
        }

        $edukasi->update($data);

        return redirect()->route('master.edukasi.index')->with('success', 'Edukasi berhasil diperbarui');
    }

    public function destroy(Edukasi $edukasi)
    {
        // Hapus file
        if ($edukasi->file) {
            Storage::disk('public')->delete($edukasi->file);
        }
        
        // Hapus cover
        if ($edukasi->cover) {
            Storage::disk('public')->delete($edukasi->cover);
        }
        
        $edukasi->delete();

        return redirect()->route('master.edukasi.index')->with('success', 'Edukasi berhasil dihapus');
    }
}