@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow-md rounded-xl p-6 mb-8">
        <h2 class="text-2xl font-bold mb-2">Welcome, {{ $user->name }}!</h2>
        <p class="text-gray-600 mb-1">Email: {{ $user->email }}</p>
        @if ($user->role === 'admin')
            <p class="text-green-600 font-semibold">Halo, kamu adalah admin.</p>
        @endif
    </div>

    {{-- Untuk User --}}
    @if ($user->role === 'user')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Presensi Card --}}
            <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col justify-between">
                <div class="flex items-center mb-4">
                    <i class="fas fa-clipboard-list text-blue-500 text-xl mr-3"></i>
                    <h3 class="text-lg font-semibold">Presensi</h3>
                </div>
                <div class="mt-auto">
                    <a href="{{ route('presensi.form') }}" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition mr-2">
                        <i class="fas fa-arrow-right mr-2"></i> Presensi
                    </a>
                    <a href="{{ route('log-presensi') }}" class="inline-flex items-center bg-gray-500 text-white px-4 py-2 rounded-full hover:bg-gray-600 transition">
                        <i class="fas fa-list mr-2"></i> Log Presensi
                    </a>
                </div>
            </div>

            {{-- Cuti Card --}}
            <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col justify-between">
                <div class="flex items-center mb-4">
                    <i class="fas fa-calendar-alt text-yellow-500 text-xl mr-3"></i>
                    <h3 class="text-lg font-semibold">Cuti</h3>
                </div>
                <div class="mt-auto">
                    <a href="#" class="inline-flex items-center bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-yellow-600 transition">
                        <i class="fas fa-arrow-right mr-2"></i> Ajukan Cuti
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- Untuk Admin --}}
    @if ($user->role === 'admin')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Manage Cuti --}}
            <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col justify-between">
                <div class="flex items-center mb-4">
                    <i class="fas fa-user-check text-purple-500 text-xl mr-3"></i>
                    <h3 class="text-lg font-semibold">Manage Cuti</h3>
                </div>
                <div class="mt-auto">
                    <a href="#" class="inline-flex items-center bg-purple-600 text-white px-4 py-2 rounded-full hover:bg-purple-700 transition">
                        <i class="fas fa-arrow-right mr-2"></i> Lihat
                    </a>
                </div>
            </div>

            {{-- Manage Data Karyawan --}}
            <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col justify-between">
                <div class="flex items-center mb-4">
                    <i class="fas fa-user-cog text-indigo-500 text-xl mr-3"></i>
                    <h3 class="text-lg font-semibold">Manage Data Karyawan</h3>
                </div>
                <div class="mt-auto">
                    <a href="#" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition">
                        <i class="fas fa-arrow-right mr-2"></i> Lihat
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
