<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Pikr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pikr_id = $request->pikr_id;
        $pikr = Pikr::findOrFail($pikr_id);
        $artikels = Artikel::where('pikr_id', $pikr_id)->latest()->paginate(10);
        
        return view('master.artikel.index', compact('artikels', 'pikr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pikr_id = $request->pikr_id;
        $pikr = Pikr::findOrFail($pikr_id);
        
        return view('master.artikel.create', compact('pikr'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pikr_id' => 'required|exists:pikrs,id',
            'isVerified' => 'nullable|boolean',
            'isReject' => 'nullable|boolean',
            'msg' => 'nullable|string',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverPath = $cover->store('artikel', 'public');
            $data['cover'] = $coverPath;
        }

        // Set default values for verification and rejection
        $data['isVerified'] = $request->has('isVerified') ? true : false;
        $data['isReject'] = $request->has('isReject') ? true : false;
        if (!$data['isReject']) {
            // Clear message if not rejected
            $data['msg'] = null;
        }

        Artikel::create($data);

        return redirect()->route('master.artikel.index', ['pikr_id' => $request->pikr_id])
            ->with('success', 'Artikel berhasil ditambahkan');
    }

    public function showLanding(Artikel $artikel)
    {
        return view('artikel.detail', compact('artikel'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        return view('master.artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        $pikr = $artikel->pikr;
        return view('master.artikel.edit', compact('artikel', 'pikr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pikr_id' => 'required|exists:pikrs,id',
            'isVerified' => 'nullable|boolean',
            'msg' => 'nullable|string',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($artikel->cover) {
                Storage::disk('public')->delete($artikel->cover);
            }
            
            $cover = $request->file('cover');
            $coverPath = $cover->store('artikel', 'public');
            $data['cover'] = $coverPath;
        }

        // Set value for isVerified from checkbox (if any)
        $data['isVerified'] = $request->has('isVerified') ? true : false;

        // If article was previously rejected, editing resets status to pending (not verified, not rejected)
        if ($artikel->isReject) {
            $data['isReject'] = false;
            $data['isVerified'] = false;
        }

        $artikel->update($data);

        return redirect()->route('master.artikel.index', ['pikr_id' => $artikel->pikr_id])
            ->with('success', 'Artikel berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        $pikr_id = $artikel->pikr_id;
        
        // Hapus cover jika ada
        if ($artikel->cover) {
            Storage::disk('public')->delete($artikel->cover);
        }
        
        $artikel->delete();

        return redirect()->route('master.artikel.index', ['pikr_id' => $pikr_id])
            ->with('success', 'Artikel berhasil dihapus');
    }
    
    /**
     * Verify the specified article.
     */
    public function verify(Artikel $artikel)
    {
        // Cek apakah user memiliki role admin
        
        
        $artikel->update(['isVerified' => true]);
        
        return redirect()->route('master.artikel.index', ['pikr_id' => $artikel->pikr_id])
            ->with('success', 'Artikel berhasil diverifikasi');
    }

    /**
     * Reject the specified article with a message.
     */
    public function reject(Request $request, Artikel $artikel)
    {
        $request->validate([
            'msg' => 'required|string'
        ]);

        $artikel->update([
            'isReject' => true,
            'isVerified' => false,
            'msg' => $request->input('msg')
        ]);

        return redirect()->route('master.artikel.index', ['pikr_id' => $artikel->pikr_id])
            ->with('success', 'Artikel berhasil ditolak dengan alasan.');
    }
}