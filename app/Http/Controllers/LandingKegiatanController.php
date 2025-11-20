<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class LandingKegiatanController extends Controller
{
    /**
     * Public JSON endpoint returning calendar events across all PIKR.
     */
    public function index(Request $request)
    {
        $search = $request->query('q');

        $query = Kegiatan::with('pikr')
            ->orderBy('tanggal_pelaksanaan', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('tema', 'like', '%' . $search . '%')
                  ->orWhere('lokasi', 'like', '%' . $search . '%');
            })->orWhereHas('pikr', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $kegiatans = $query->get();

        $events = $kegiatans->map(function ($kegiatan) {
            $pikr = $kegiatan->pikr;
            $logoUrl = ($pikr && $pikr->logo) ? asset('storage/' . $pikr->logo) : null;

            return [
                'id' => $kegiatan->id,
                'title' => $kegiatan->name,
                'start' => optional($kegiatan->tanggal_pelaksanaan)->format('Y-m-d'),
                // Clicking an event goes to PIKR detail page
                'url' => $pikr ? route('pikr.detail', $pikr->id) : null,
                // Extra props for rendering and tooltips
                'description' => $kegiatan->tema,
                'location' => $kegiatan->lokasi,
                'pikr_name' => $pikr ? $pikr->name : null,
                'logo_url' => $logoUrl,
            ];
        });

        return response()->json([
            'events' => $events,
        ]);
    }
}