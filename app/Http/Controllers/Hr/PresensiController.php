<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $presensi = Presensi::with('karyawan')->latest()->get();
        return view('hr.presensi.index', compact('presensi'));
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        return view('hr.presensi.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'required',
            'waktu_keluar' => 'nullable',
            'status' => 'required'
        ]);

        Presensi::create($validated);

        return redirect()->route('hr.presensi.index')->with('success', 'Presensi berhasil dicatat');
    }
}