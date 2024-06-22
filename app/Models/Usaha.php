<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use App\Traits\UUID;
class Usaha extends Model
{
    use HasFactory, SoftDeletes, UUID;

    public $timestamps = true;
    public $fillable = [
        'id_pemilik',
        'id_pasar',
        'id_blok',
        'nama_usaha',
        'foto_usaha',
        'tgl_tagihan',
        'jlh_tagihan',
    ];
}
