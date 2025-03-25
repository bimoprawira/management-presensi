<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Presensi;
use App\Models\Cuti;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $presensiHariIni = Presensi::whereDate('tanggal', today())->count();
        $pengajuanCuti = Cuti::where('status_persetujuan', 'Menunggu')->count();

        return view('hr.dashboard.index', compact('totalKaryawan', 'presensiHariIni', 'pengajuanCuti'));
    }
}