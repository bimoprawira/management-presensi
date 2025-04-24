@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-4 text-center">Data Karyawan</h3>

        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Jabatan</th>
                    <th class="px-4 py-2 border">Departemen</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($karyawans as $karyawan)
                    <tr>
                        <td class="border px-4 py-2">{{ $karyawan->name }}</td>
                        <td class="border px-4 py-2">{{ $karyawan->email }}</td>
                        <td class="border px-4 py-2">{{ $karyawan->jabatan ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $karyawan->departemen ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Belum ada data karyawan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
