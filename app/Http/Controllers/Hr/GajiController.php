<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::with('karyawan')->latest()->get();
        return view('hr.gaji.index', compact('gaji'));
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        return view('hr.gaji.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'gaji_pokok' => 'required|numeric',
            'komponen_tambahan' => 'required|numeric',
            'potongan' => 'required|numeric',
            'periode_pembayaran' => 'required|date'
        ]);

        Gaji::create($validated);

        return redirect()->route('hr.gaji.index')->with('success', 'Data gaji berhasil disimpan');
    }
}