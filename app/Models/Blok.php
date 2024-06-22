<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use App\Traits\UUID;

class Blok extends Model
{
    use HasFactory,UUID, SoftDeletes;
    public $timestamps = true;
    public $fillable = ['id_pasar', 'nama'];
}
