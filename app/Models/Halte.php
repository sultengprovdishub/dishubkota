<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Halte extends Model
{
    protected $table = 'halte';

    protected $fillable = [
        'koridor_id',
        'nama',
        'latitude',
        'longitude',
        'tipe',
        'urutan',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function koridor(): BelongsTo
    {
        return $this->belongsTo(Koridor::class);
    }
}
