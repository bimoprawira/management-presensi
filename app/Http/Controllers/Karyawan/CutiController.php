<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = Cuti::where('id_karyawan', auth()->id())
                   ->latest()
                   ->get();
        
        return view('karyawan.cuti.index', compact('cuti'));
    }

    public function create()
    {
        return view('karyawan.cuti.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required'
        ]);

        Cuti::create([
            'id_karyawan' => auth()->id(),
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'alasan' => $validated['alasan'],
            'status_persetujuan' => 'Menunggu'
        ]);

        return redirect()->route('karyawan.cuti.index')->with('success', 'Pengajuan cuti berhasil dikirim');
    }
}