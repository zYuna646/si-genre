<?php

namespace App\Http\Controllers;

use App\Models\KategoriEdukasi;
use Illuminate\Http\Request;

class KategoriEdukasiController extends Controller
{
    public function index()
    {
        $kategori = KategoriEdukasi::all();
        return view('admin.kategori_edukasi.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori_edukasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        KategoriEdukasi::create([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);

        return redirect()->route('master.kategori_edukasi.index')->with('success', 'Kategori Edukasi berhasil ditambahkan');
    }

    public function edit(KategoriEdukasi $kategori_edukasi)
    {
        return view('admin.kategori_edukasi.edit', compact('kategori_edukasi'));
    }

    public function update(Request $request, KategoriEdukasi $kategori_edukasi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        $kategori_edukasi->update([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);

        return redirect()->route('master.kategori_edukasi.index')->with('success', 'Kategori Edukasi berhasil diperbarui');
    }

    public function destroy(KategoriEdukasi $kategori_edukasi)
    {
        // Cek apakah kategori memiliki edukasi
        if ($kategori_edukasi->edukasi()->count() > 0) {
            return redirect()->route('master.kategori_edukasi.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki edukasi');
        }
        
        $kategori_edukasi->delete();

        return redirect()->route('master.kategori_edukasi.index')->with('success', 'Kategori Edukasi berhasil dihapus');
    }
}