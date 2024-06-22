<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use App\Traits\UUID;

class Pembayaran extends Model
{
    use HasFactory, UUID, SoftDeletes;
    public $timestamps = true;
    public $fillable = [
        'id_usaha',
        'id_pemilik',
        'id_pasar',
        'id_rekening',
        'tgl_pembayaran',
        'jlh_pembayaran',
        'denda',
        'total',
        'bukti_pembayaran',
        'status',
        'updated_by',
        'deleted_by'
    ];
}
