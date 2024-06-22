<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use App\Traits\UUID;

class Penindakan extends Model
{
    use HasFactory, SoftDeletes, UUID;
    public $timestamps = true;
    public $fillable = [
        'judul',
        'deskripsi',
        'foto'
    ];
}
