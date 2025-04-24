<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Presensi;
use App\Models\Cuti;
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

        // Hitung sisa cuti
        $cutis = Cuti::all(); // ✅ Ambil semua cuti yang ada
        $totalHariCutiAktif = $cutis
            ->whereIn('status_persetujuan', ['Disetujui', 'Diproses'])
            ->reduce(function ($carry, $item) {
                return $carry + Carbon::parse($item->tgl_mulai)
                            ->diffInDays(Carbon::parse($item->tgl_selesai)) + 1;
            }, 0);

        $jatahCutiDefault = 5;
        $sisaCuti = max(0, $jatahCutiDefault - $totalHariCutiAktif);

        return view('dashboard', compact('totalPresensi', 'gajiLembur', 'sisaCuti'));
    }
}
