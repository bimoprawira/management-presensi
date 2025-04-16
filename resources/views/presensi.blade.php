@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-md text-center mb-8">
        <h2 class="text-xl font-bold mb-4">Presensi Hari Ini</h2>
        <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow">
            Presensi Disini
        </button>
    </div>

<!-- Modal -->
<div id="presensiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative">
        <button onclick="closeModal()" class="absolute top-2 right-4 text-gray-600 hover:text-black text-2xl font-bold">&times;</button>
        <h3 class="text-lg font-semibold mb-4">Form Presensi</h3>

        <form id="presensiForm" action="{{ route('presensi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="presensi_id" id="presensi_id">
            <input type="hidden" name="tanggal" id="tanggal">
            <input type="hidden" name="geolokasi" id="geolokasi">
            <input type="hidden" name="type" id="type">

            <div class="mb-4 text-left">
                <label for="status" class="block font-medium mb-1">Status</label>
                <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="sehat">Sehat</option>
                    <option value="sakit">Sakit</option>
                    <option value="izin">Izin</option>
                </select>
            </div>

            <div class="text-sm text-gray-500 mb-4" id="loadingLocation">Mengambil lokasi...</div>

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
    function uuidv4() {
        return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    }

    function openModal() {
        document.getElementById('presensiModal').classList.remove('hidden');
        const now = new Date();
        document.getElementById('tanggal').value = now.toISOString().split('T')[0];
        document.getElementById('presensi_id').value = uuidv4();
        document.getElementById('loadingLocation').innerText = 'Mengambil lokasi...';

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const coords = `${position.coords.latitude},${position.coords.longitude}`;
                    document.getElementById('geolokasi').value = coords;
                    document.getElementById('loadingLocation').innerText = 'Lokasi berhasil diambil';
                },
                () => {
                    document.getElementById('geolokasi').value = 'Gagal mendapatkan lokasi';
                    document.getElementById('loadingLocation').innerText = 'Gagal mendapatkan lokasi';
                }
            );
        }
    }

    function closeModal() {
        document.getElementById('presensiModal').classList.add('hidden');
    }

    function submitPresensi(type) {
        document.getElementById('type').value = type;

        const now = new Date();
        const time = now.toTimeString().split(':').slice(0, 2).join(':');

        const inputName = type === 'masuk' ? 'time_clock_in' : 'time_clock_out';

        document.querySelectorAll('input[name="time_clock_in"], input[name="time_clock_out"]').forEach(el => el.remove());

        const timeInput = document.createElement('input');
        timeInput.type = 'hidden';
        timeInput.name = inputName;
        timeInput.value = time;
        document.getElementById('presensiForm').appendChild(timeInput);

        document.getElementById('presensiForm').submit();
    }
</script>
@endsection
