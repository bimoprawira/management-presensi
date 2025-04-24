<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Presensi;

class LogPresensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $presensis = Presensi::where('user_id', $user->id)->orderBy('tanggal', 'desc')->get();

        return view('logpresensi', compact('presensis'));
    }
}
