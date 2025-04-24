<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HR Presence Management')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in {
            animation: fadeIn 1.5s ease-out forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-800 font-sans min-h-screen flex items-center justify-center">

    @auth
    <div class="absolute top-4 right-4">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
        <button 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md transition">
            Logout
        </button>
    </div>
    @endauth

    <div class=" text-center fade-in">
        <img src="{{ asset('https://png.pngtree.com/png-vector/20240724/ourmid/pngtree-cute-little-baby-capybara-being-sweet-png-image_12942220.png') }}" alt="Logo" class="mx-auto w-24 h-24 rounded-full mb-6 shadow-lg">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-4 leading-tight">HR <span class="text-blue-400">Sistem Management Presensi</span>
        </h1>
        <p class="text-lg text-gray-300 mb-8">
            Silahkan login atau registrasi terlebih dahulu untuk melanjutkan.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white rounded-xl text-lg font-semibold hover:bg-blue-700 transition shadow-lg">Login</a>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-600 text-white rounded-xl text-lg font-semibold hover:bg-gray-700 transition shadow-lg">Register</a>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
