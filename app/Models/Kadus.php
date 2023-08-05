<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kadus extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'kadus';
    protected $hidden = ['id'];
    protected $fillable = [
        'uuid',
        'id_pengguna',
        'nama',
        'dusun',
        'desa',
        'kecamatan'
    ];
}
