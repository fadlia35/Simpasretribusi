<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use App\Traits\UUID;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pemilik extends Authenticatable
{
    use HasFactory, UUID, SoftDeletes, Notifiable;
    protected $guard = 'pemilik';
    public $timestamps = true;
    protected $fillable = [
        'nama_pemilik',
        'nik',
        'foto_pemilik',
        'alamat',
        'password', 
    ];
    
}
