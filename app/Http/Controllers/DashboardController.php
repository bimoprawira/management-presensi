<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Presensi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $now = Carbon::now();

    // Hitung jumlah kehadiran bulan ini
    $totalPresensi = Presensi::where('user_id', $user->id)
        ->whereMonth('tanggal', $now->month)
        ->whereYear('tanggal', $now->year)
        ->count();

    // Hitung total jam lembur (lebih dari 8 jam)
    $presensis = Presensi::where('user_id', $user->id)
        ->whereMonth('tanggal', $now->month)
        ->whereYear('tanggal', $now->year)
        ->get();

    $gajiLembur = 0;
    $lemburRatePerJam = 25000; // contoh rate lembur

    foreach ($presensis as $p) {
        if ($p->time_clock_in && $p->time_clock_out) {
            $start = Carbon::parse($p->time_clock_in);
            $end = Carbon::parse($p->time_clock_out);
            $durasiJam = $end->diffInHours($start);

            if ($durasiJam > 8) {
                $gajiLembur += ($durasiJam - 8) * $lemburRatePerJam;
            }
        }
    }

    return view('dashboard', compact('totalPresensi', 'gajiLembur'));
}
}