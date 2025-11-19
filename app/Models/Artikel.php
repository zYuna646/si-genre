<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';
    protected $fillable = ['title', 'content', 'cover', 'pikr_id', 'isVerified', 'isReject', 'msg'];

    protected $casts = [
        'isVerified' => 'boolean',
        'isReject' => 'boolean',
    ];

    public function pikr()
    {
        return $this->belongsTo(Pikr::class);
    }
}