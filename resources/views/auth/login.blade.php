<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-elephant-50 via-elephant-100 to-forest-green-50">
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Decorative Background Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-elephant-200/30 to-forest-green-200/30 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-forest-green-200/30 to-elephant-200/30 rounded-full blur-3xl"></div>
            </div>

            <!-- Logo and Header -->
            <div class="text-center relative z-10">
                <div class="bg-white/80 backdrop-blur-sm rounded-full p-6 w-32 h-32 mx-auto mb-6 shadow-lg border border-elephant-200/50">
                    <img class="w-full h-full object-contain" src="{{ asset('logo.png') }}" alt="Logo">
                </div>
                <h2 class="mt-6 text-3xl font-bold text-elephant-900">
                    Masuk ke Akun Anda
                </h2>
                <p class="mt-2 text-sm text-elephant-700">
                    Silakan masukkan kredensial Anda untuk melanjutkan
                </p>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="relative z-10">
                    <x-alert type="success" dismissible="true">
                        {{ session('success') }}
                    </x-alert>
                </div>
            @endif

            @if(session('error'))
                <div class="relative z-10">
                    <x-alert type="danger" dismissible="true">
                        {{ session('error') }}
                    </x-alert>
                </div>
            @endif

            <!-- Login Form -->
            <div class="relative z-10">
                <x-card class="mt-8 bg-white/90 backdrop-blur-sm border-elephant-200/50 shadow-xl">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Email Field -->
                        <x-input
                            type="email"
                            name="email"
                            label="Alamat Email"
                            placeholder="Masukkan email Anda"
                            required="true"
                            :value="old('email')"
                            :icon="'<path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207\'></path>'"
                        />

                        <!-- Password Field -->
                        <x-input
                            type="password"
                            name="password"
                            label="Kata Sandi"
                            placeholder="Masukkan kata sandi Anda"
                            required="true"
                            :icon="'<path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z\'></path>'"
                        />

                        <!-- Remember Me Checkbox -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input
                                    id="remember"
                                    name="remember"
                                    type="checkbox"
                                    class="h-4 w-4 text-elephant-600 focus:ring-elephant-500 border-elephant-300 rounded"
                                >
                                <label for="remember" class="ml-2 block text-sm text-elephant-800">
                                    Ingat saya
                                </label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-elephant-600 hover:text-elephant-700 transition-colors">
                                    Lupa kata sandi?
                                </a>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <x-button
                            type="submit"
                            variant="primary"
                            size="lg"
                            class="w-full shadow-lg transform hover:scale-[1.02] transition-all duration-200"
                            :icon="'<path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1\'></path>'"
                            iconPosition="right"
                        >
                            Masuk
                        </x-button>
                    </form>
                </x-card>
            </div>

            <!-- Additional Links -->
            <div class="text-center relative z-10">
                <div class="bg-white/70 backdrop-blur-sm rounded-lg p-4 border border-elephant-200/50">
                    <p class="text-sm text-elephant-700">
                        Belum punya akun?
                        <a href="#" class="font-medium text-forest-green-600 hover:text-forest-green-700 transition-colors">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center relative z-10">
                <x-button
                    href="{{ route('welcome') }}"
                    variant="ghost"
                    size="sm"
                    class="text-elephant-600 hover:text-elephant-700 hover:bg-white/50 backdrop-blur-sm"
                    :icon="'<path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M10 19l-7-7m0 0l7-7m-7 7h18\'></path>'"
                >
                    Kembali ke Beranda
                </x-button>
            </div>
        </div>
    </div>

    <!-- Alpine.js for interactive components -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>