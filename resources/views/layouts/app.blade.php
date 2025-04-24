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
<body class="bg-gray-900 text-white font-sans relative">

    @auth
    <!-- Logout Button -->
    <div class="absolute top-4 right-4 z-50">
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
        <aside class="bg-gray-700 p-4 rounded">
            <div class="p-6 text-center border-b border-white/20">
                <a href="{{ route('dashboard') }}">
                    <img src="https://png.pngtree.com/png-vector/20240724/ourmid/pngtree-cute-little-baby-capybara-being-sweet-png-image_12942220.png" 
                         alt="Logo" 
                         class="w-20 h-20">
                </a>
                
                <a href="{{ route('dashboard') }}" class="mt-3 text-lg font-semibold">
                    <h5>HR Presence</h5>
                </a>
                
            </div>
            <div class="p-6 space-y-4">
                <a href="{{ route('presensi.form') }}" class="block text-white font-semibold hover:underline">Presensi</a>
                
                {{-- Belum aktif --}}
                <a href="{{ route('cuti') }}" class="block text-white font-semibold hover:underline">Cuti</a>
                <span class="block text-white font-semibold opacity-50 cursor-not-allowed">Gaji</span>
                <span class="block text-white font-semibold opacity-50 cursor-not-allowed">Profil</span>
            </div>
        </aside>
        @endauth

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
