<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kadus extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'kadus';
    protected $hidden = ['id'];
    protected $fillable = [
        'uuid',
        'id_pengguna',
        'id_jabatan',
        'email',
        'nama',
        'dusun',
        'desa',
        'kecamatan'
    ];

    public function jabatan(): HasOne
    {
        return $this->hasOne(Jabatan::class, 'id', 'id_jabatan');
    }

    public function pengguna(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_pengguna');
    }
}
