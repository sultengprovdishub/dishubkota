<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakPesan extends Model
{
    use HasFactory;

    protected $table = 'kontak_pesan';

    protected $fillable = ['nama', 'email', 'telepon', 'subjek', 'pesan', 'dibaca'];

    protected $casts = ['dibaca' => 'boolean'];
}
