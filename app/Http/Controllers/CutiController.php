<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CutiController extends Controller
{
    public function index()
    {
        // Ambil semua data cuti, bisa difilter nanti berdasarkan user
        $cuti = Cuti::all();

        // Hitung total hari cuti yang disetujui
        // Hitung semua cuti yang masih Diproses atau Disetujui
        $totalHariCutiAktif = $cuti
        ->whereIn('status_persetujuan', ['Disetujui', 'Diproses']) // <--- ubah di sini
        ->reduce(function ($carry, $item) {
            return $carry + Carbon::parse($item->tgl_mulai)->diffInDays(Carbon::parse($item->tgl_selesai)) + 1;
        }, 0);

        $jatahCutiDefault = 5;
        $sisaCuti = max(0, $jatahCutiDefault - $totalHariCutiAktif);


        return view('cuti', compact('cuti', 'sisaCuti'));
    }

    public function store(Request $request)
{
    $request->validate([
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'alasan' => 'required|string|max:255',
    ]);

    // Hitung durasi hari cuti yang diajukan
    $durasiCuti = Carbon::parse($request->tanggal_mulai)
        ->diffInDays(Carbon::parse($request->tanggal_selesai)) + 1;

    // Tolak jika durasi lebih dari 5 hari
    if ($durasiCuti > 5) {
        return redirect()->back()->withErrors(['Durasi cuti maksimal 5 hari.']);
    }

    // Tetap pakai validasi sisa cuti dari data yang disetujui
    $cuti = Cuti::all();
    $totalHariDisetujui = $cuti
        ->where('status_persetujuan', 'Disetujui')
        ->reduce(function ($carry, $item) {
            return $carry + Carbon::parse($item->tgl_mulai)->diffInDays(Carbon::parse($item->tgl_selesai)) + 1;
        }, 0);

    $jatahCutiDefault = 5;
    $sisaCuti = max(0, $jatahCutiDefault - $totalHariDisetujui);

    // Tolak jika melebihi sisa cuti yang tersedia
    if ($durasiCuti > $sisaCuti) {
        return redirect()->back()->withErrors(['Durasi cuti melebihi sisa cuti yang tersedia.']);
    }

    // Simpan pengajuan cuti
    Cuti::create([
        'tgl_mulai' => $request->tanggal_mulai,
        'tgl_selesai' => $request->tanggal_selesai,
        'alasan' => $request->alasan,
        'status_persetujuan' => 'Diproses',
        'jatah_cuti' => $jatahCutiDefault
    ]);

    return redirect()->back()->with('success', 'Pengajuan cuti berhasil dikirim.');
}

}
