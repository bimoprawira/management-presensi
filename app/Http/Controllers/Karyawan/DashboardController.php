<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Cuti;
use App\Models\Gaji;

class DashboardController extends Controller
{
    public function index()
    {
        $karyawan = auth()->user();
        
        $presensi = Presensi::where('id_karyawan', $karyawan->id_karyawan)
                          ->latest()
                          ->limit(5)
                          ->get();
        
        $cuti = Cuti::where('id_karyawan', $karyawan->id_karyawan)
                   ->latest()
                   ->limit(3)
                   ->get();
        
        $gaji = Gaji::where('id_karyawan', $karyawan->id_karyawan)
                   ->latest()
                   ->limit(3)
                   ->get();

        return view('karyawan.dashboard', compact('karyawan', 'presensi', 'cuti', 'gaji'));
    }
}