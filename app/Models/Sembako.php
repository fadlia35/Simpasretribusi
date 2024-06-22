<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use App\Traits\UUID;

class Sembako extends Model
{
    use HasFactory, SoftDeletes, UUID;
    public $timestamps = true;
    public $fillable = [
        'nama_sembako',
        'harga'
    ];
}
