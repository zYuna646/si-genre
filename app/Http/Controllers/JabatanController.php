<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Anggota;
use App\Models\Pikr;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pikr_id = $request->pikr_id;
        $pikr = Pikr::findOrFail($pikr_id);
        $jabatans = Jabatan::where('pikr_id', $pikr_id)->paginate(10);
        
        return view('master.jabatan.index', compact('jabatans', 'pikr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pikr_id = $request->pikr_id;
        $pikr = Pikr::findOrFail($pikr_id);
        $jabatans = Jabatan::where('pikr_id', $pikr_id)->get();
        $anggotas = Anggota::where('pikr_id', $pikr_id)->get();
        
        return view('master.jabatan.create', compact('pikr', 'jabatans', 'anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'anggota_ids' => 'required|array',
            'anggota_ids.*' => 'exists:anggotas,id',
            'jabatan_id' => 'nullable|exists:jabatans,id',
            'pikr_id' => 'required|exists:pikrs,id',
        ]);

        $jabatan = Jabatan::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'jabatan_id' => $request->jabatan_id,
            'pikr_id' => $request->pikr_id,
        ]);
        
        $jabatan->anggotas()->attach($request->anggota_ids);

        return redirect()->route('master.jabatan.index', ['pikr_id' => $request->pikr_id])
            ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        $pikr = $jabatan->pikr;
        $parent = $jabatan->parent;
        
        $anggotas = $jabatan->anggotas;
        return view('master.jabatan.show', compact('jabatan', 'pikr', 'parent', 'anggotas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        $pikr = $jabatan->pikr;
        $selectedAnggotas = $jabatan->anggotas;
        $jabatans = Jabatan::where('id', '!=', $jabatan->id)
                          ->where('pikr_id', $jabatan->pikr_id)
                          ->get();
        $anggotas = Anggota::where('pikr_id', $jabatan->pikr_id)->get();
        
        return view('master.jabatan.edit', compact('jabatan', 'pikr', 'jabatans', 'anggotas', 'selectedAnggotas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'anggota_ids' => 'required|array',
            'anggota_ids.*' => 'exists:anggotas,id',
            'jabatan_id' => 'nullable|exists:jabatans,id',
        ]);

        $jabatan->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'jabatan_id' => $request->jabatan_id,
        ]);
        
        $jabatan->anggotas()->sync($request->anggota_ids);

        return redirect()->route('master.jabatan.index', ['pikr_id' => $jabatan->pikr_id])
            ->with('success', 'Jabatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        $pikr_id = $jabatan->pikr_id;
        $jabatan->delete();
        
        return redirect()->route('master.jabatan.index', ['pikr_id' => $pikr_id])
            ->with('success', 'Jabatan berhasil dihapus.');
    }
    
    /**
     * Get the hierarchical structure of positions and their members.
     */
    public function getStructure(Request $request)
    {
        $pikr_id = $request->pikr_id;
        
        $jabatans = Jabatan::with(['anggotas' => function($query) {
            $query->select('anggotas.id', 'anggotas.nama');
        }])->where('pikr_id', $pikr_id)->get();
        
        return response()->json($jabatans);
    }
}
