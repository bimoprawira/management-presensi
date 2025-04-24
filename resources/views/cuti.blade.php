@extends('layouts.app')

@section('title', 'Cuti')

@section('content')
<div class="max-w-4xl mx-auto text-white">
    <h1 class="text-3xl font-bold mb-6">Menu Cuti</h1>

    @if($cuti->count() > 0)
       <!-- Info Jatah Cuti -->
        @if($cuti->count() > 0)
        <div class="bg-gray-800 p-4 rounded-lg mb-6">
            <h2 class="text-xl font-semibold">Sisa Jatah Cuti</h2>
            <p class="text-2xl font-bold mt-2">{{ $sisaCuti }} Hari</p>
        </div>
        @endif


        <!-- Log Cuti -->
        <div class="bg-gray-800 p-4 rounded-lg mb-6">
            <h2 class="text-xl font-semibold mb-4">Log Cuti</h2>
            <table class="w-full table-auto text-left">
                <thead>
                    <tr>
                        <th class="pb-2">Tanggal Pengajuan</th>
                        <th class="pb-2">Tanggal Cuti</th>
                        <th class="pb-2">Alasan</th>
                        <th class="pb-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuti as $item)
                    <tr class="border-t border-gray-700">
                        <td class="py-2">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                        <td>{{ $item->tgl_mulai }} - {{ $item->tgl_selesai }}</td>
                        <td>{{ $item->alasan }}</td>
                        <td>
                            @if ($item->status_persetujuan === 'Disetujui')
                                <span class="text-green-400 font-semibold">Disetujui</span>
                            @elseif ($item->status_persetujuan === 'Ditolak')
                                <span class="text-red-400 font-semibold">Ditolak</span>
                            @else
                                <span class="text-yellow-400 font-semibold">Diproses</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-gray-800 p-4 rounded-lg mb-6 text-center">
            <p class="text-lg">Belum ada pengajuan cuti yang tercatat.</p>
        </div>
    @endif

    <!-- Form Ajukan Cuti -->
    <div class="bg-gray-800 p-4 rounded-lg mb-6">
        <h2 class="text-xl font-semibold mb-4">Ajukan Cuti</h2>
        <form action="{{ route('cuti.ajukan') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="tanggal_mulai" class="block font-semibold mb-1">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full p-2 rounded bg-gray-700 text-white">
            </div>
            <div class="mb-4">
                <label for="tanggal_selesai" class="block font-semibold mb-1">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full p-2 rounded bg-gray-700 text-white">
            </div>
            <div class="mb-4">
                <label for="alasan" class="block font-semibold mb-1">Alasan Cuti</label>
                <textarea name="alasan" id="alasan" rows="3" class="w-full p-2 rounded bg-gray-700 text-white"></textarea>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Ajukan Cuti</button>
        </form>
    </div>
</div>
@endsection
