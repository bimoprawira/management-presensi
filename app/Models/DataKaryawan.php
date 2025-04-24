<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DataKaryawan;

class DataKaryawan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
