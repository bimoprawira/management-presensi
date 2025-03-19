<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-800 text-white">
    <div class="container mx-auto mt-10">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="p-6 text-center">
                        <h2 class="text-2xl text-gray-900 font-bold">Register</h2>
                    </div>
                    <div class="p-6">
                        <form action="/register" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-900">Username</label>
                                <input type="text" name="name"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-900
                                @error('name') border-red-500 @enderror"
                                    id="name" placeholder="Username" required value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-900">Email</label>
                                <input type="email" name="email"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-900
                                @error('email') border-red-500 @enderror"
                                    id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-900">Password</label>
                                <input type="password" name="password"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-900
                                @error('password') border-red-500 @enderror"
                                    id="password" required>
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-gray-900">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-900
                                @error('password_confirmation') border-red-500 @enderror"
                                    id="password_confirmation" required>
                                @error('password_confirmation')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit"
                                class="w-full bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg">Register</button>
                        </form>
                    </div>
                    <div class="p-6 text-gray-900 text-center">
                        <p>Udah punya akun? <a href="{{ route('login') }}" class="text-blue-500">Log in aja!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
