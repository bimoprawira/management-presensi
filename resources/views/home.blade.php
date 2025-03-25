@extends('layouts.app')
@section('title', 'Home')
@section('content')

    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="justify-content-center">
            <div class=" content-box">
                <h1 class="display-4" style="font-size: 5rem; font-weight: 500;">Sistem Management Presensi</h1>
                <p class="lead">Untuk melanjutkan, silahkan login atau registrasi terlebih dahulu.</p>
                <div class="mt-4">
                    <a class="btn btn-secondary btn-lg" href="{{ route('login') }}" role="button">Login</a>
                    <a class="btn btn-secondary btn-lg" href="{{ route('register') }}" role="button">Register</a>
                </div>
            </div>
        </div>
    </div>

@endsection