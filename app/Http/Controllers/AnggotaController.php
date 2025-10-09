<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pikr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pikr_id = $request->pikr_id;
        $pikr = Pikr::findOrFail($pikr_id);
        $anggotas = Anggota::where('pikr_id', $pikr_id)->latest()->paginate(10);
        
        return view('master.anggota.index', compact('anggotas', 'pikr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pikr_id = $request->pikr_id;
        $pikr = Pikr::findOrFail($pikr_id);
        
        return view('master.anggota.create', compact('pikr'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pikr_id' => 'required|exists:pikrs,id',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('anggota', 'public');
            $data['foto'] = $fotoPath;
        }

        Anggota::create($data);

        return redirect()->route('master.anggota.index', ['pikr_id' => $request->pikr_id])
            ->with('success', 'Anggota berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        return view('master.anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggota)
    {
        $pikr = $anggota->pikr;
        return view('master.anggota.edit', compact('anggota', 'pikr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pikr_id' => 'required|exists:pikrs,id',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            
            $foto = $request->file('foto');
            $fotoPath = $foto->store('anggota', 'public');
            $data['foto'] = $fotoPath;
        }

        $anggota->update($data);

        return redirect()->route('master.anggota.index', ['pikr_id' => $anggota->pikr_id])
            ->with('success', 'Anggota berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggota)
    {
        $pikr_id = $anggota->pikr_id;
        
        // Hapus foto jika ada
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }
        
        $anggota->delete();

        return redirect()->route('master.anggota.index', ['pikr_id' => $pikr_id])
            ->with('success', 'Anggota berhasil dihapus');
    }
}
