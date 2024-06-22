<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use App\Traits\UUID;
class Rekening extends Model
{
    use HasFactory, SoftDeletes, UUID;
    public $timestamps = true;
    public $fillable = [
        'nama_bank',
        'no_rek',
        'atas_nama',
        'foto'
    ];
}
