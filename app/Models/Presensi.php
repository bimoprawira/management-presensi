<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensis';

    protected $fillable = [
        'id',
        'user_id',
        'tanggal',
        'status',
        'geolokasi',
        'time_clock_in',
        'time_clock_out'
    ];

    protected $casts = [
        'id' => 'string',
        'tanggal' => 'date',
        'time_clock_in' => 'datetime:H:i',
        'time_clock_out' => 'datetime:H:i'
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}
