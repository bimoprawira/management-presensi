@extends('hr.layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Total Karyawan -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-700">Total Karyawan</h3>
        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalKaryawan }}</p>
    </div>
    
    <!-- Presensi Hari Ini -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-700">Presensi Hari Ini</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">{{ $presensiHariIni }}</p>
    </div>
    
    <!-- Pengajuan Cuti -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-700">Pengajuan Cuti</h3>
        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pengajuanCuti }}</p>
    </div>
</div>

<div class="mt-8 bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Aktivitas Terkini</h3>
    <!-- Daftar aktivitas -->
    <div class="space-y-4">
        @foreach($recentActivities as $activity)
        <div class="border-b pb-4 last:border-b-0">
            <p class="text-sm text-gray-600">{{ $activity->created_at->diffForHumans() }}</p>
            <p>{{ $activity->description }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection