<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-800 text-white">
    <div class="container mx-auto mt-10">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="p-6 text-center">
                        <h2 class="text-2xl font-bold block text-gray-900">Login</h2>
                    </div>
                    <div class="p-6">
                        @if (session('success'))
                            <div class="bg-green-500 text-white p-4 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session()->has('loginError'))
                            <div class="bg-red-500 text-white p-4 rounded mb-4" role="alert">
                                {{ session('loginError') }}
                            </div>
                        @endif
                        <form action="/login" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="login" class="block text-gray-900">Email atau Username:</label>
                                <input 
                                    type="text" 
                                    id="login" 
                                    name="login" 
                                    placeholder="Email atau Username Anda" 
                                    autofocus 
                                    class="w-full px-4 py-2 border rounded-lg text-gray-900" 
                                    required
                                    value="{{ old('login') }}"
                                >
                                @error('login')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            <div class="mb-4">
                                <label for="password" class="block text-gray-900">Password:</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="w-full px-4 py-2 border rounded-lg text-gray-900" 
                                    required
                                >
                                @error('password')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        
                            <button 
                                type="submit"
                                class="w-full bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg"
                            >
                                Login
                            </button>
                        </form>
                    </div>
                    <div class="p-6 text-center block text-gray-900">
                        <p>Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500">Daftar, yuk!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
