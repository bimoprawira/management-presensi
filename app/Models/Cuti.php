<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cuti';

    protected $fillable = [
        'tgl_mulai',
        'tgl_selesai',
        'status_persetujuan',
        'alasan',
        'tgl_persetujuan',
        'jatah_cuti',
    ];
}
