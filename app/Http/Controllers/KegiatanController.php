<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pikr;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pikr_id = $request->pikr_id;
        $pikr = Pikr::findOrFail($pikr_id);
        $kegiatans = Kegiatan::where('pikr_id', $pikr_id)->latest()->paginate(10);
        
        return view('master.kegiatan.index', compact('kegiatans', 'pikr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pikr_id = $request->pikr_id;
        $pikr = Pikr::findOrFail($pikr_id);
        
        return view('master.kegiatan.create', compact('pikr'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pikr_id' => 'required|exists:pikrs,id',
            'name' => 'required|string|max:255',
            'tujuan' => 'nullable|string',
            'tema' => 'nullable|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'lokasi' => 'required|string|max:255',
        ]);

        Kegiatan::create($request->all());

        return redirect()->route('master.kegiatan.index', ['pikr_id' => $request->pikr_id])
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        $pikr = $kegiatan->pikr;
        return view('master.kegiatan.show', compact('kegiatan', 'pikr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        $pikr = $kegiatan->pikr;
        return view('master.kegiatan.edit', compact('kegiatan', 'pikr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tujuan' => 'nullable|string',
            'tema' => 'nullable|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'lokasi' => 'required|string|max:255',
        ]);

        $kegiatan->update($request->all());

        return redirect()->route('master.kegiatan.index', ['pikr_id' => $kegiatan->pikr_id])
            ->with('success', 'Kegiatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $pikr_id = $kegiatan->pikr_id;
        $kegiatan->delete();

        return redirect()->route('master.kegiatan.index', ['pikr_id' => $pikr_id])
            ->with('success', 'Kegiatan berhasil dihapus');
    }

    /**
     * Display the calendar view of activities.
     */
    public function calendar(Request $request)
    {
        $pikr_id = $request->pikr_id;
        $pikr = Pikr::findOrFail($pikr_id);
        $kegiatans = Kegiatan::where('pikr_id', $pikr_id)->get();
        
        // Format kegiatan untuk kalender
        $events = [];
        foreach ($kegiatans as $kegiatan) {
            $events[] = [
                'id' => $kegiatan->id,
                'title' => $kegiatan->name,
                'start' => $kegiatan->tanggal_pelaksanaan->format('Y-m-d'),
                'url' => route('master.kegiatan.show', $kegiatan->id),
                'description' => $kegiatan->tema,
                'location' => $kegiatan->lokasi
            ];
        }
        
        return view('master.kegiatan.calendar', compact('pikr', 'events'));
    }
}
