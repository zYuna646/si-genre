<?php

namespace App\Http\Controllers;

use App\Models\Pikr;
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Jabatan;
use App\Models\Artikel;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function pikrPdf()
    {
        $pikrs = Pikr::all();
        $pdf = PDF::loadView('admin.laporan.pikr', compact('pikrs'));
        return $pdf->download('laporan-pikr.pdf');
    }

    public function pikrDetailPdf($id)
    {
        $pikr = Pikr::findOrFail($id);
        $anggota = Anggota::where('pikr_id', $id)->with('jabatans')->get();
        $kegiatan = Kegiatan::where('pikr_id', $id)->with('laporanKegiatan')->get();
        $artikel = Artikel::where('pikr_id', $id)->get();
        $jabatans = Jabatan::where('pikr_id', $id)->with(['anggotas', 'parent'])->get();

        $pdf = PDF::loadView('admin.laporan.pikr_detail', compact('pikr', 'anggota', 'kegiatan', 'artikel', 'jabatans'));
        return $pdf->download('laporan-pikr-detail-'.$pikr->name.'.pdf');
    }

    public function anggotaPdf()
    {
        $anggota = Anggota::with(['pikr', 'jabatans'])->get();
        $pdf = PDF::loadView('admin.laporan.anggota', compact('anggota'));
        return $pdf->download('laporan-anggota.pdf');
    }

    public function kegiatanPdf()
    {
        $kegiatan = Kegiatan::with('pikr')->get();
        $pdf = PDF::loadView('admin.laporan.kegiatan', compact('kegiatan'));
        return $pdf->download('laporan-kegiatan.pdf');
    }
}