<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;
    protected $table = 'keluarga';
    protected $hidden = ['id'];
    protected $fillable = [
        'uuid',
        'id_pengguna',
        'no_kk',
        'nama_kepala_keluarga',
        'dusun',
        'desa',
        'kecamatan',
        'alamat',
    ];
}
