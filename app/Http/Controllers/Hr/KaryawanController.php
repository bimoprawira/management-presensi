<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;


{
    protected $table = 'karyawan'; // Sesuaikan dengan nama tabel di database
    
    // ... kode lainnya
}

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('hr.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        return view('hr.karyawan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawan',
            'jabatan' => 'required',
            'tanggal_bergabung' => 'required|date'
        ]);

        Karyawan::create($validated);

        return redirect()->route('hr.karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit(Karyawan $karyawan)
    {
        return view('hr.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawan,email,'.$karyawan->id_karyawan.',id_karyawan',
            'jabatan' => 'required',
            'tanggal_bergabung' => 'required|date'
        ]);

        $karyawan->update($validated);

        return redirect()->route('hr.karyawan.index')->with('success', 'Data karyawan berhasil diupdate');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('hr.karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }
}