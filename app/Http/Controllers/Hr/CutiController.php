<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = Cuti::with('karyawan')->latest()->get();
        return view('hr.cuti.index', compact('cuti'));
    }

    public function approve(Cuti $cuti)
    {
        $cuti->update([
            'status_persetujuan' => 'Disetujui',
            'tanggal_persetujuan' => now()
        ]);

        return back()->with('success', 'Cuti telah disetujui');
    }

    public function reject(Cuti $cuti)
    {
        $cuti->update([
            'status_persetujuan' => 'Ditolak',
            'tanggal_persetujuan' => now()
        ]);

        return back()->with('success', 'Cuti telah ditolak');
    }
}