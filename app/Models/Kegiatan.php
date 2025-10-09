<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    protected $fillable = [
        'pikr_id',
        'name',
        'tujuan',
        'tema',
        'tanggal_pelaksanaan',
        'lokasi',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
    ];

    /**
     * Get the PIKR that owns the kegiatan.
     */
    public function pikr(): BelongsTo
    {
        return $this->belongsTo(Pikr::class);
    }

    /**
     * Get the laporan for the kegiatan.
     */
    public function laporan()
    {
        return $this->hasOne(LaporanKegiatan::class);
    }

    public function laporanKegiatan()
    {
        return $this->hasOne(LaporanKegiatan::class);
    }
}
