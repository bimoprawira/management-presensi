<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id_karyawan';
    protected $fillable = [
        'nama',
        'email',
        'password',
        'jabatan',
        'tanggal_bergabung'
    ];
    protected $hidden = ['password'];

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id_karyawan');
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_karyawan');
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class, 'id_karyawan');
    }
}