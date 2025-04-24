@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="text-white">
        <h2 class="text-2xl font-bold mb-2">Good Morning, {{ Auth::user()->name }} 👋</h2>
        <p class="text-gray-300 mb-4">Email: {{ Auth::user()->email }}</p>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-white">
            <div class="bg-gray-700 p-4 rounded">
                <p class="text-sm mb-2">Grafik Kehadiran Bulan Ini</p>
                <canvas id="kehadiranChart" height="100"></canvas>
            </div>
            
            <div class="bg-gray-700 p-4 rounded">
                <p class="text-sm">Sisa Cuti</p>
                <div class="bg-gray-700 p-4 rounded-xl mt-6">
                    
                    <canvas id="kehadiranChart" height="100"></canvas>
                </div>
                
                <h3 class="text-2xl font-bold">4 Hari</h3>
            </div>
            <div class="bg-gray-700 mt-4 p-4 rounded">
                <p class="text-sm">Gaji Lembur</p>
                <h3 class="text-2xl font-bold text-white">Rp {{ number_format($gajiLembur, 0, ',', '.') }}</h3>
            </div>
            
        </div>

        <div class="bg-gray-700 mt-6 p-4 rounded">
            <h3 class="text-lg font-semibold mb-2">Pengumuman</h3>
            <p class="text-gray-300">Libur nasional tanggal 1 Mei 2025 (Hari Buruh). Tetap semangat bekerja 💪</p>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('kehadiranChart').getContext('2d');
    const kehadiranChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Kehadiran Bulan Ini', 'Target Kehadiran'],
            datasets: [{
                label: 'Hari',
                data: [{{ $totalPresensi }}, 20],
                backgroundColor: ['#3b82f6', '#9ca3af']
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, max: 25 }
            }
        }
    });
</script>
