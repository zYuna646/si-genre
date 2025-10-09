<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use Illuminate\Http\Request;

class EdukasiDetailController extends Controller
{
    public function show($id)
    {
        $edukasi = Edukasi::with('kategori')->findOrFail($id);
        return view('edukasi.detail', compact('edukasi'));
    }
}