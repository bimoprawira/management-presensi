<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $presensi = Presensi::where('id_karyawan', auth()->id())
                          ->latest()
                          ->get();
        
        return view('karyawan.presensi.index', compact('presensi'));
    }

    public function create()
    {
        return view('karyawan.presensi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required'
        ]);

        Presensi::create([
            'id_karyawan' => auth()->id(),
            'tanggal' => now()->format('Y-m-d'),
            'waktu_masuk' => now()->format('H:i:s'),
            'status' => $validated['status']
        ]);

        return redirect()->route('karyawan.presensi.index')->with('success', 'Presensi berhasil dicatat');
    }
}