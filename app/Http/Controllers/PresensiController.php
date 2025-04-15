<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function form()
    {
        return view('presensi');
    }

    public function store(Request $request)
    {
        \Log::info('Form Data:', $request->all());
        dd($request->all());

        // Cek apakah form yang disubmit mengarah ke controller
        dd('Form is submitted!');

        $validated = $request->validate([
            'presensi_id' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:sehat,sakit,izin',
            'geolokasi' => 'required',
            'type' => 'required|in:masuk,keluar',
            'time_clock_in' => 'required_if:type,masuk|nullable|date_format:H:i:s',
            'time_clock_out' => 'required_if:type,keluar|nullable|date_format:H:i:s',
        ]);

        \Log::info('Validated data:', $validated);

        $userId = auth()->id();
        \Log::info('User ID: ' . $userId);

        // Cek apakah user sudah presensi di tanggal ini
        $presensi = Presensi::where('user_id', $userId)
                            ->where('tanggal', $validated['tanggal'])
                            ->first();

        // Kalau belum ada presensi untuk tanggal ini, buat baru
        if (!$presensi) {
            $presensi = new Presensi();
            $presensi->id = $validated['presensi_id'];
            $presensi->user_id = $userId;
            $presensi->tanggal = $validated['tanggal'];
            $presensi->status = $validated['status'];
            $presensi->geolokasi = $validated['geolokasi'];
        }

        // Isi clock in atau clock out
        if ($request->type === 'masuk' && !$presensi->time_clock_in) {
            $presensi->time_clock_in = $request->time_clock_in;
        } elseif ($request->type === 'keluar' && !$presensi->time_clock_out) {
            $presensi->time_clock_out = $request->time_clock_out;
        }

        \Log::info('Presensi data before save:', $presensi->toArray());
        $presensi->save();

        return redirect()->route('dashboard')->with('success', 'Presensi berhasil disimpan.');
    }
}
