<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PresensiController extends Controller
{
    public function form()
    {
        $userId = Auth::id();
        $presensis = Presensi::where('user_id', $userId)->orderBy('tanggal', 'desc')->get();
        return view('presensi', compact('presensis'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'tanggal' => 'required|date',
        'status' => 'required|string',
        'geolokasi' => 'nullable|string',
        'type' => 'required|in:masuk,keluar',
        'time_clock_in' => 'nullable',
        'time_clock_out' => 'nullable',
    ]);

    $userId = Auth::id();

    $presensi = Presensi::firstOrNew([
        'user_id' => $userId,
        'tanggal' => $validated['tanggal'],
    ]);

    if (!$presensi->exists) {
        $presensi->id = Str::uuid(); // UUID dibuat di server
    }

    $presensi->status = $validated['status'];
    $presensi->geolokasi = $validated['geolokasi'];

    if ($validated['type'] === 'masuk' && isset($validated['time_clock_in'])) {
        $presensi->time_clock_in = $validated['time_clock_in'];
    } elseif ($validated['type'] === 'keluar' && isset($validated['time_clock_out'])) {
        $presensi->time_clock_out = $validated['time_clock_out'];
    }

    $presensi->save();

    return redirect()->route('dashboard')->with('success', 'Presensi berhasil disimpan.');
}
    public function logPresensi()
    {
        $user = Auth::user();
        $presensis = Presensi::where('user_id', $user->id)->orderBy('tanggal', 'desc')->get();

        return view('log-presensi', compact('presensis', 'user'));
    }

}
