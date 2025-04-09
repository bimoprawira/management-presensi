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
                        <form action="/register" method="POST" id="registerForm">
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
                                    <span class="text-red-500 text-sm">
                                        Password harus mengandung minimal 8 karakter, 
                                        1 huruf besar, 1 huruf kecil, dan 1 simbol
                                    </span>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">
                                    Password harus mengandung minimal 8 karakter, 1 huruf besar, dan 1 simbol
                                </p>
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-gray-900">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-900"
                                    id="password_confirmation" required>
                                <div id="passwordMatchError" class="hidden text-red-500 text-sm mt-1">
                                    Password tidak cocok!
                                </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const passwordMatchError = document.getElementById('passwordMatchError');
            const registerForm = document.getElementById('registerForm');

            function checkPasswordMatch() {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.add('border-red-500');
                    passwordMatchError.classList.remove('hidden');
                    return false;
                } else {
                    confirmPasswordInput.classList.remove('border-red-500');
                    passwordMatchError.classList.add('hidden');
                    return true;
                }
            }

            // Real-time validation
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
            passwordInput.addEventListener('input', checkPasswordMatch);

            // Form submission validation (Form tidak bisa di submit jika ada yang salah pada register)
            registerForm.addEventListener('submit', function(event) {
                if (!checkPasswordMatch()) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>