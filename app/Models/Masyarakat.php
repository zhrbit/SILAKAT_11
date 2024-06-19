<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable
{
    use HasFactory;

    protected $table = 'masyarakat';

    protected $primaryKey = 'nik';

    public $incrementing = false;

    protected $fillable = [
        'nik',
        'name',
        'email',
        'email_verified_at',
        'username',
        'jenis_kelamin',
        'password',
        'telp',
        'alamat',
        'rt',
        'rw',
    ];

}
