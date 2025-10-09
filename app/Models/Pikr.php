<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pikr extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'user_id',
        'sk',
        'logo',
    ];

    /**
     * Get the user that owns the PIKR.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
