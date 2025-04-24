@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-gray-700 p-6 rounded-2xl shadow-md text-center relative border border-gray-200">

        {{-- Log Presensi link pindah ke pojok kanan --}}
        <div class="absolute top-4 right-4">
            <a href="{{ route('log-presensi') }}" class="inline-block bg-gray-100 hover:bg-gray-200 text-sm text-gray-800 px-4 py-2 rounded-md transition shadow-sm">
                Log Presensi →
            </a>
        </div>

        <h2 class="text-2xl font-bold text-gray-100 mb-6">Presensi Hari Ini</h2>

        {{-- Dua tombol langsung membuka modal --}}
        <div class="flex justify-center space-x-4">
            <button onclick="openModal('masuk')" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold shadow">
                Presensi Masuk
            </button>
            <button onclick="openModal('keluar')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow">
                Presensi Keluar
            </button>
        </div>
    </div>

    {{-- Modal Presensi --}}
    <div id="presensiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-gray-800 w-full max-w-lg p-6 rounded-2xl shadow-xl relative border border-gray-600">
            <button onclick="closeModal()" class="absolute top-3 right-4 text-gray-300 hover:text-white text-2xl font-bold">&times;</button>
            <h3 class="text-xl font-semibold mb-4 text-center text-white">Form Presensi</h3>

            <form id="presensiForm" action="{{ route('presensi.store') }}" method="POST" class="space-y-6 text-sm">
                @if(session('error'))
                    <div class="mt-4 text-red-400 text-sm text-center">
                        {{ session('error') }}
                    </div>
                @endif
                @csrf
                <input type="hidden" name="presensi_id" id="presensi_id">
                <input type="hidden" name="tanggal" id="tanggal">
                <input type="hidden" name="geolokasi" id="geolokasi">
                <input type="hidden" name="type" id="type">

                <div>
                    <label for="status" class="block text-gray-300 font-medium mb-2">Status Hari Ini</label>
                    <select name="status" id="status" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-xl shadow focus:outline-none focus:ring-2 focus:ring-blue-500 text-white">
                        <option value="sehat" class="bg-gray-700">Sehat</option>
                        <option value="sakit" class="bg-gray-700">Sakit</option>
                        <option value="izin" class="bg-gray-700">Izin</option>
                    </select>
                </div>

                <div id="loadingLocation" class="text-xs text-gray-400 italic">
                    Mengambil lokasi...
                </div>

                <div class="pt-2 text-right">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 transition text-white px-6 py-2 rounded-xl font-semibold shadow-md">
                        Simpan Presensi
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    const todayPresensi = {!! json_encode($todayPresensi) !!};
    function uuidv4() {
        return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    }

    function openModal(type) {
        const now = new Date();
        const todayDate = now.toISOString().split('T')[0];

        if (type === 'masuk' && todayPresensi && todayPresensi.time_clock_in) {
            alert("Kamu sudah melakukan presensi masuk hari ini.");
            return;
        }

        if (type === 'keluar') {
            if (!todayPresensi || !todayPresensi.time_clock_in) {
                alert("Kamu belum melakukan presensi masuk hari ini.");
                return;
            }
            if (todayPresensi.time_clock_out) {
                alert("Kamu sudah melakukan presensi keluar hari ini.");
                return;
            }
        }

        document.getElementById('presensiModal').classList.remove('hidden');
        document.getElementById('tanggal').value = todayDate;
        document.getElementById('presensi_id').value = uuidv4();
        document.getElementById('type').value = type;
        document.getElementById('loadingLocation').innerText = 'Mengambil lokasi...';

        document.querySelectorAll('input[name="time_clock_in"], input[name="time_clock_out"]').forEach(el => el.remove());

        const time = now.toTimeString().split(':').slice(0, 2).join(':');
        const inputName = type === 'masuk' ? 'time_clock_in' : 'time_clock_out';
        const timeInput = document.createElement('input');
        timeInput.type = 'hidden';
        timeInput.name = inputName;
        timeInput.value = time;
        document.getElementById('presensiForm').appendChild(timeInput);

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
</script>
@endsection
