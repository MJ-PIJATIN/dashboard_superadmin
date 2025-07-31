@extends('layouts.login')
@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo -->
        <div class="text-center">
            <div class="mx-auto w-20 h-20 flex items-center justify-center">
                <div class="flex justify-center">
                    <img src="{{ asset('images/logo_apl_login.svg') }}" alt="Logo Login" class="h-20 w-20 mb-5">
                </div>
            </div>
        </div>

        <!-- Login Form -->
        <div class="bg-white py-12 px-8 shadow-lg rounded-2xl border border-gray-200">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Selamat Datang, Super Admin</h2>
                <p class="text-xs text-gray-500">Silahkan masukkan username dan password Anda</p>
            </div>

            @if ($errors->any())
                <div id="error-popup" class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-2 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Masukkan email anda"
                        class="text-sm w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent text-gray-700 placeholder-gray-400"
                        required
                    >
                </div>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Masukkan password anda"
                        class="text-sm mb-7 w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent text-gray-700 placeholder-gray-400 pr-12"
                        required
                    >
                    <!-- Eye icon untuk show/hide password -->
                    <button 
                        type="button" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center mb-7"
                        onclick="togglePassword()">
                        <svg id="eye-closed" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                        <svg id="eye-open" class="w-5 h-5 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <div class="pt-2">
                    <button 
                        type="submit" 
                        class="w-full bg-teal-500 text-white py-2 px-3 rounded-lg font-medium hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition duration-200">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeClosed = document.getElementById('eye-closed');
    const eyeOpen = document.getElementById('eye-open');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeClosed.classList.add('hidden');
        eyeOpen.classList.remove('hidden');
    } else {
        passwordInput.type = 'password';
        eyeClosed.classList.remove('hidden');
        eyeOpen.classList.add('hidden');
    }
}

// Function to show error popup for 1 second
document.addEventListener('DOMContentLoaded', function() {
    const errorPopup = document.getElementById('error-popup');
    if (errorPopup) {
        setTimeout(() => {
            errorPopup.style.display = 'none';
        }, 2000);
    }
});
</script>
@endsection