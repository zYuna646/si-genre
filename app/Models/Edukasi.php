<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edukasi extends Model
{
    use HasFactory;

    protected $table = 'edukasi';
    protected $fillable = ['name', 'desc', 'file', 'cover', 'kategori_edukasi_id'];

    public function kategori()
    {
        return $this->belongsTo(KategoriEdukasi::class, 'kategori_edukasi_id');
    }
}