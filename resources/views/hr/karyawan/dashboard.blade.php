@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Karyawan</div>

                <div class="card-body">
                    <h4>Selamat datang, {{ auth()->user()->nama }}</h4>
                    <p>Jabatan: {{ auth()->user()->jabatan }}</p>
                    
                    <div class="mt-4">
                        <h5>Presensi Terakhir</h5>
                        <ul>
                            @foreach($presensi as $item)
                            <li>{{ $item->tanggal }} - {{ $item->status }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection