<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AktaKawin extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'akta_kawin';
    protected $hidden = ['id'];
    protected $fillable = [
        'uuid', //
        'no_akta_kawin',
        'id_pengguna'
    ];
}
