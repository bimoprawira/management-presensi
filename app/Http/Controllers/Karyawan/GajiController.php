<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Gaji;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::where('id_karyawan', auth()->id())
                   ->latest()
                   ->get();
        
        return view('karyawan.gaji.index', compact('gaji'));
    }
}