@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h2 class="text-xl font-bold mb-4">Presensi Hari Ini</h2>
        <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow">
            Presensi Disini
        </button>
    </div>
</div>

<!-- Modal -->
<div id="presensiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative">
        <button onclick="closeModal()" class="absolute top-2 right-4 text-gray-600 hover:text-black">&times;</button>
        <h3 class="text-lg font-semibold mb-4">Form Presensi</h3>
        <form action="{{ route('presensi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="presensi_id" id="presensi_id" value="">
            <input type="hidden" name="tanggal" id="tanggal">
            <input type="hidden" name="geolokasi" id="geolokasi">
            <input type="hidden" name="type" id="type"> <!-- masuk atau keluar -->

            <div class="mb-4 text-left">
                <label for="status" class="block font-medium mb-1">Status</label>
                <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="sehat">Sehat</option>
                    <option value="sakit">Sakit</option>
                    <option value="izin">Izin</option>
                </select>
            </div>

            <div class="flex space-x-4">
                <button type="button" onclick="submitPresensi('masuk')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full">
                    Presensi Masuk
                </button>
                <button type="button" onclick="submitPresensi('keluar')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
                    Presensi Keluar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('presensiModal').classList.remove('hidden');

        const now = new Date();
        document.getElementById('tanggal').value = now.toISOString().split('T')[0];

        // Generate ID Sementara
        const idPresensi = Date.now();
        document.getElementById('presensi_id').value = idPresensi;

        // Geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const coords = `${position.coords.latitude},${position.coords.longitude}`;
                document.getElementById('geolokasi').value = coords;
            }, () => {
                document.getElementById('geolokasi').value = 'Gagal mendapatkan lokasi';
            });
        }
    }

    function closeModal() {
        document.getElementById('presensiModal').classList.add('hidden');
    }

    function submitPresensi(type) {
        document.getElementById('type').value = type;

        const now = new Date();
        const time = now.toTimeString().split(' ')[0]; // Format HH:MM:SS

        // Hapus input waktu sebelumnya (jika ada)
        const existingInputIn = document.querySelector('input[name="time_clock_in"]');
        if (existingInputIn) existingInputIn.remove();

        const existingInputOut = document.querySelector('input[name="time_clock_out"]');
        if (existingInputOut) existingInputOut.remove();

        // Buat input baru sesuai jenis presensi
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = type === 'masuk' ? 'time_clock_in' : 'time_clock_out';
        hiddenInput.value = time;
        document.querySelector('form').appendChild(hiddenInput);

        document.querySelector('form').submit();
    }
</script>

@endsection
