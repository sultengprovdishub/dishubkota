<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = ['nama', 'ikon', 'deskripsi', 'url', 'urutan', 'aktif'];

    protected $casts = ['aktif' => 'boolean'];
}
