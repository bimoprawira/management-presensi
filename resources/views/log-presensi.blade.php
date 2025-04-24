@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-center w-full">Riwayat Presensi</h3>
        </div>

        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ route('dashboard') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md transition">
                ← Kembali ke Dashboard
            </a>
        </div>

        @if($presensis->count())
            <table class="w-full table-auto text-left border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Tanggal</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Clock In</th>
                        <th class="p-2 border">Clock Out</th>
                        <th class="p-2 border">Geolokasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($presensis as $presensi)
                    <tr>
                        <td class="p-2 border">{{ $presensi->tanggal }}</td>
                        <td class="p-2 border">{{ ucfirst($presensi->status) }}</td>
                        <td class="p-2 border">{{ $presensi->time_clock_in ?? '-' }}</td>
                        <td class="p-2 border">{{ $presensi->time_clock_out ?? '-' }}</td>
                        <td class="p-2 border text-xs text-gray-600">{{ $presensi->geolokasi ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-gray-500">Belum ada data presensi.</p>
        @endif
    </div>
</div>
@endsection
