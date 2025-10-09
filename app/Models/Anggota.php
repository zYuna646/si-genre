<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'foto',
        'tanggal_lahir',
        'jenis_kelamin',
        'pikr_id'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function pikr()
    {
        return $this->belongsTo(Pikr::class);
    }
    
    public function prestasis()
    {
        return $this->hasMany(Prestasi::class);
    }
    
    public function jabatans()
    {
        return $this->belongsToMany(Jabatan::class, 'anggota_jabatan');
    }
}
