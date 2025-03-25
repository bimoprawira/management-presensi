<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_gaji';
    protected $fillable = [
        'id_karyawan',
        'gaji_pokok',
        'komponen_tambahan',
        'potongan',
        'periode_pembayaran'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}