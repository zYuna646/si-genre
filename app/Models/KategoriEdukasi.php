<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriEdukasi extends Model
{
    use HasFactory;

    protected $table = 'kategori_edukasi';
    protected $fillable = ['name', 'desc'];

    public function edukasi()
    {
        return $this->hasMany(Edukasi::class, 'kategori_edukasi_id');
    }
}