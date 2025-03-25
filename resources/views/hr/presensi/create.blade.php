@extends('hr.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Tambah Presensi</h2>
    
    <form action="{{ route('hr.presensi.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="id_karyawan" class="block text-sm font-medium text-gray-700">Karyawan</label>
                <select id="id_karyawan" name="id_karyawan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach($karyawan as $k)
                    <option value="{{ $k->id_karyawan }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ now()->format('Y-m-d') }}">
            </div>
            
            <div>
                <label for="waktu_masuk" class="block text-sm font-medium text-gray-700">Waktu Masuk</label>
                <input type="time" id="waktu_masuk" name="waktu_masuk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="waktu_keluar" class="block text-sm font-medium text-gray-700">Waktu Keluar</label>
                <input type="time" id="waktu_keluar" name="waktu_keluar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="Masuk">Masuk</option>
                    <option value="Terlambat">Terlambat</option>
                    <option value="Cuti">Cuti</option>
                    <option value="Izin">Izin</option>
                    <option value="Absen">Absen</option>
                </select>
            </div>
        </div>
        
        <div class="mt-8">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Presensi
            </button>
        </div>
    </form>
</div>
@endsection