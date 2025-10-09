<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'jenis_kompetisi',
        'prestasi',
        'sertifikat',
        'deskripsi',
        'bukti_foto',
    ];

    protected $casts = [
        'bukti_foto' => 'array',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
