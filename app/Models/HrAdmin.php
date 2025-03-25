<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HrAdmin extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'username',
        'password',
        'role'
    ];
    protected $hidden = ['password'];
}