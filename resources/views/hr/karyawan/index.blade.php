@extends('hr.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-700">Daftar Karyawan</h2>
    <a href="{{ route('hr.karyawan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Tambah Karyawan
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bergabung</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($karyawan as $k)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $k->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $k->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $k->jabatan }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $k->tanggal_bergabung->format('d M Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('hr.karyawan.edit', $k->id_karyawan) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                    <form action="{{ route('hr.karyawan.destroy', $k->id_karyawan) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="px-6 py-4">
        {{ $karyawan->links() }}
    </div>
</div>
@endsection