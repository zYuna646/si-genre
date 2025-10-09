<?php

namespace App\Http\Controllers;

use App\Models\Pikr;
use App\Models\Jabatan;
use App\Models\Anggota;
use App\Models\Prestasi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class PikrDetailController extends Controller
{
    public function show($id)
    {
        $pikr = Pikr::findOrFail($id);
        $jabatan = Jabatan::where('pikr_id', $id)->get();
        $anggota = Anggota::where('pikr_id', $id)->get();
        $prestasi = Prestasi::whereIn('anggota_id', $anggota->pluck('id'))->get();
        $kegiatan = Kegiatan::where('pikr_id', $id)->get();

        return view('pikr.detail', compact('pikr', 'jabatan', 'anggota', 'prestasi', 'kegiatan'));
    }
}