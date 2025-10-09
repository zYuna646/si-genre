<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'jabatan_id',
        'pikr_id'
    ];

    public function anggotas()
    {
        return $this->belongsToMany(Anggota::class, 'anggota_jabatan');
    }

    public function parent()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function children()
    {
        return $this->hasMany(Jabatan::class, 'jabatan_id');
    }
    
    public function pikr()
    {
        return $this->belongsTo(Pikr::class);
    }
}
