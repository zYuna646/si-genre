<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKegiatan extends Model
{
    protected $fillable = [
        'kegiatan_id',
        'jumlah_peserta',
        'daftar_hadir',
        'dokumentasi_foto',
        'dokumentasi_video',
        'ringkasan_kegiatan',
        'surat_undangan',
        'notulen_rapat',
        'brosur_poster',
        'isVerified',
    ];
    
    protected $casts = [
        'isVerified' => 'boolean',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
