<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HR Presence Management')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans relative">
    
    @auth
    <!-- Logout Button -->
    <div class="absolute top-4 right-4">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
        <button 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md">
            Logout
        </button>
    </div>
    @endauth
    
    <div id="app" class="flex min-h-screen">
        @auth
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-blue-500 to-cyan-400 text-white shadow-lg flex flex-col">
            <div class="p-6 text-center border-b border-white/20">
                <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="mx-auto w-24 h-24 rounded-full border-4 border-white">
                <h5 class="mt-3 text-lg font-semibold">HR Presence</h5>
            </div>
        </div>
        @endauth
        
        <!-- Main Content -->
        <div class="flex-1 p-6 flex justify-center items-center min-h-screen">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-gray-800">Sistem Management Presensi</h1>
                <p class="text-lg text-gray-600 mt-4">Untuk melanjutkan, silahkan login atau registrasi terlebih dahulu.</p>
                <div class="mt-6">
                    <a class="px-6 py-3 bg-blue-500 text-white text-lg font-medium rounded-lg shadow hover:bg-blue-600" href="{{ route('login') }}">Login</a>
                    <a class="ml-4 px-6 py-3 bg-gray-500 text-white text-lg font-medium rounded-lg shadow hover:bg-gray-600" href="{{ route('register') }}">Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
