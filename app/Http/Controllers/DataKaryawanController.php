<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DataKaryawanController extends Controller
{
    public function index()
    {
        $karyawans = User::where('role', 'user')
            ->leftJoin('data_karyawan', 'users.id', '=', 'data_karyawan.user_id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'data_karyawan.jabatan',
                'data_karyawan.departemen',
                'data_karyawan.tanggal_bergabung'
            )
            ->get();

        return view('admin.datakaryawan', compact('karyawans'));
    }
}
