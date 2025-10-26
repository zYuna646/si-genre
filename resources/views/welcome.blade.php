<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Animasi untuk elemen-elemen landing page */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes blob {
            0% { transform: scale(1); }
            33% { transform: scale(1.1); }
            66% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        .animate-fade-in {
            animation: fadeIn 1.5s ease-out forwards;
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }
        
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        
        /* Animasi untuk scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }
        
        .reveal.active {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }
        
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Tema biru muda */
        :root {
            --brand: #67cdf2;
            --brand-dark: #4fb9e5;
            --brand-darker: #2898c8;
        }
        .brand-gradient { background: linear-gradient(to right, var(--brand), var(--brand-dark)); }
        .brand-glow { background: linear-gradient(to right, var(--brand), var(--brand-darker)); }
        .hover-brand:hover { color: var(--brand); }
        .brand-pill { background-color: rgba(103,205,242,0.15); color: #0a4e68; }
        .brand-btn { background-color: var(--brand-dark); border-color: var(--brand-darker); }
        .brand-text { color: var(--brand-darker); }
        .dark-balloon { background-color: #0f1f2d; }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <!-- Header/Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                    <span class="ml-3 text-xl font-semibold text-gray-900">GENRE</span>
                </div>
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-gray-900 px-3 py-2 text-sm font-medium hover-brand">Beranda</a>
                    <a href="#tentang" class="text-gray-900 px-3 py-2 text-sm font-medium hover-brand">Tentang</a>
                    <a href="#pikr" class="text-gray-900 px-3 py-2 text-sm font-medium hover-brand">PIKR</a>
                    <a href="#artikel" class="text-gray-900 px-3 py-2 text-sm font-medium hover-brand">Artikel</a>
                    <a href="#edukasi" class="text-gray-900 px-3 py-2 text-sm font-medium hover-brand">Edukasi</a>
                    <a href="{{ route('login') }}" class="text-white px-4 py-2 rounded-md text-sm font-medium brand-btn hover:opacity-90">Login</a>
                </nav>
                <div class="flex items-center md:hidden">
                    <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu, show/hide based on menu state -->
        <div class="mobile-menu hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#beranda" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Beranda</a>
                <a href="#tentang" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Tentang</a>
                <a href="#pikr" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">PIKR</a>
                <a href="#artikel" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Artikel</a>
                <a href="#edukasi" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">Edukasi</a>
                <a href="{{ route('login') }}" class="block w-full text-center px-3 py-2 rounded-md text-base font-medium text-white brand-btn hover:opacity-90">Login</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="beranda" class="relative brand-gradient overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden opacity-40">
            <div class="absolute -top-10 -left-10 w-40 h-40 rounded-full mix-blend-overlay animate-blob dark-balloon"></div>
            <div class="absolute top-0 right-0 w-72 h-72 rounded-full mix-blend-overlay animate-blob animation-delay-2000 dark-balloon"></div>
            <div class="absolute bottom-0 left-1/4 w-56 h-56 rounded-full mix-blend-overlay animate-blob animation-delay-4000 dark-balloon"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 relative z-10">
            <div class="md:flex md:items-center md:space-x-8">
                <div class="md:w-1/2 text-center md:text-left mb-8 md:mb-0 animate-fade-in-up">
                    <div class="inline-block px-3 py-1 brand-pill rounded-full text-sm font-semibold mb-4 animate-pulse">
                        #GenerasiBerencana
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight">
                        Pusat Informasi & <span style="">Konseling Remaja</span>
                    </h1>
                    <p class="mt-4 text-xl" style="color: #eaf7fd">
                        Menyediakan informasi dan konseling untuk remaja tentang kesehatan reproduksi, pencegahan pernikahan dini, dan perencanaan kehidupan.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4 justify-center md:justify-start">
                        <a href="#pikr" class="px-6 py-3 bg-white font-medium rounded-md shadow-md transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1" style="color: var(--brand-darker); border: 1px solid var(--brand-darker)">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                                Lihat PIKR
                            </span>
                        </a>
                        <a href="#edukasi" class="px-6 py-3 text-white font-medium rounded-md shadow-md transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 brand-btn" style="border: 1px solid var(--brand-darker)">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                                Materi Edukasi
                            </span>
                        </a>
                    </div>
                    
                    <!-- Statistik dipindah ke bawah maskot -->
                </div>
                <div class="md:w-1/2 relative animate-fade-in">
                    <div class="absolute -inset-0.5 brand-glow rounded-full blur-2xl opacity-75 animate-pulse animation-delay-2000"></div>
                    <img src="{{ asset('img/maskot.png') }}" alt="Maskot GENRE" class="w-3/4 max-w-sm mx-auto md:max-w-md h-auto object-contain relative z-10 animate-float">
                    <!-- Statistik di bawah maskot -->
                    <div class="mt-6 grid grid-cols-2 gap-4 max-w-sm mx-auto">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold brand-text">50+</div>
                            <div class="text-white/80 text-sm">PIKR Aktif</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center">
                            <div class="text-3xl font-bold brand-text">1000+</div>
                            <div class="text-white/80 text-sm">Remaja Teredukasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-16 bg-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute -right-20 -top-20 w-64 h-64 rounded-full opacity-50" style="background-color: rgba(103,205,242,0.12)"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 rounded-full opacity-50" style="background-color: rgba(103,205,242,0.08)"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal">

                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Tentang <span class="brand-text">GENRE</span></h2>
                <div class="mt-4 inline-block px-4 py-2 rounded-lg max-w-3xl mx-auto" style="background-color:#dff6e3; color:#0f5132; border: 1px solid #90ddaa">GENRE (Generasi Berencana) adalah program yang dikembangkan untuk mempersiapkan kehidupan berkeluarga bagi remaja melalui pemahaman tentang pendewasaan usia perkawinan.</div>
                <div class="w-24 h-1 mx-auto mt-6" style="background-color: var(--brand)"></div>
            </div>
            
            <div class="md:flex md:items-center md:space-x-8 p-6 rounded-xl" style="background-color: rgba(103,205,242,0.08); border: 1px solid var(--brand)">
                <div class="md:w-1/2 mb-8 md:mb-0 reveal">
                    <img src="{{ asset('img/landing/WhatsApp Image 2025-09-30 at 20.29.46_18ccfa48.jpg') }}" alt="Tentang GENRE" class="rounded-lg shadow-lg w-full h-auto transform transition-all duration-300 hover:scale-105">
                </div>
                <div class="md:w-1/2 reveal">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Generasi Berencana</h3>
                    <!-- Paragraf dipindahkan ke highlight atas -->
                    <p class="text-gray-700 mb-4">
                        Program ini bertujuan untuk meningkatkan pemahaman dan kesadaran remaja tentang kesehatan reproduksi, mencegah pernikahan dini, dan mempersiapkan kehidupan berkeluarga yang berkualitas.
                    </p>
                    
                    <!-- Feature list -->
                    <ul class="mt-6 space-y-3">
                        <li class="flex items-center text-gray-700">
                            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--brand)">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Pendewasaan Usia Perkawinan
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--brand)">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Kesehatan Reproduksi Remaja
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--brand)">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Perencanaan Kehidupan Berkualitas
                        </li>
                    </ul>
                    
                    <!-- Statistik dipindahkan ke baris di bawah kotak -->
                </div>
            </div>

            <!-- Statistik: satu baris di bawah kotak -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 reveal">
                <div class="p-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300" style="background-color: rgba(103,205,242,0.12)">
                    <div class="text-xl font-bold brand-text">1000+</div>
                    <div class="text-gray-700">Remaja Teredukasi</div>
                </div>
                <div class="p-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300" style="background-color: rgba(103,205,242,0.12)">
                    <div class="text-xl font-bold brand-text">50+</div>
                    <div class="text-gray-700">PIKR Aktif</div>
                </div>
                <div class="p-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300" style="background-color: rgba(103,205,242,0.12)">
                    <div class="text-xl font-bold brand-text">100+</div>
                    <div class="text-gray-700">Kegiatan Tahunan</div>
                </div>
                <div class="p-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300" style="background-color: rgba(103,205,242,0.12)">
                    <div class="text-xl font-bold brand-text">20+</div>
                    <div class="text-gray-700">Materi Edukasi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel Section -->
    <section id="artikel" class="py-16 bg-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute -right-20 -top-20 w-64 h-64 rounded-full opacity-50" style="background-color: rgba(103,205,242,0.12)"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 rounded-full opacity-50" style="background-color: rgba(103,205,242,0.08)"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal">
                <span class="inline-block px-3 py-1 brand-pill rounded-full text-sm font-semibold mb-4">Artikel Terbaru</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Artikel <span class="brand-text">Terverifikasi</span></h2>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">Informasi dan Edukasi dari PIKR</p>
                <div class="w-24 h-1 mx-auto mt-6" style="background-color: var(--brand)"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach(\App\Models\Artikel::where('isVerified', true)->latest()->take(6)->get() as $artikel)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl reveal">
                    <div class="h-3" style="background-color: var(--brand)"></div>
                    <div class="h-48 flex items-center justify-center" style="background-color: rgba(103,205,242,0.08)">
                        @if($artikel->cover)
                            <img src="{{ asset('storage/' . $artikel->cover) }}" alt="{{ $artikel->title }}" class="h-full w-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full w-full" style="background-color: rgba(103,205,242,0.16)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" style="color: var(--brand)" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1M19 20a2 2 0 002-2V8a2 2 0 00-2-2h-5M8 12h.01M12 12h.01M16 12h.01M8 16h.01M12 16h.01M16 16h.01" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $artikel->title }}</h3>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Terverifikasi</span>
                        </div>
                        
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $artikel->created_at->format('d M Y') }}</span>
                            
                            <span class="mx-2">•</span>
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>{{ $artikel->pikr->name ?? 'PIKR' }}</span>
                        </div>
                        
                        <a href="#" class="inline-flex items-center px-4 py-2 font-medium rounded-lg transition-all duration-300 shadow-md hover:shadow-lg brand-btn" style="background-color: var(--brand); border: 1px solid var(--brand-darker); color: white;">
                            <span>Baca Artikel</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-10">
                <a href="#" class="inline-flex items-center px-6 py-3 font-medium rounded-lg transition-all duration-300" style="background-color: rgba(103,205,242,0.08); color: var(--brand); border: 1px solid var(--brand);">
                    <span>Lihat Semua Artikel</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--brand)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- PIKR Section -->
    <section id="pikr" class="py-16 bg-gradient-to-b from-white to-[#eaf7fd] relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-white to-transparent"></div>
        <div class="absolute -left-16 top-1/4 w-32 h-32 rounded-full opacity-30 animate-blob animation-delay-2000" style="background-color: rgba(103,205,242,0.16)"></div>
        <div class="absolute -right-16 bottom-1/4 w-32 h-32 rounded-full opacity-30 animate-blob" style="background-color: rgba(103,205,242,0.24)"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal">
                <span class="inline-block px-3 py-1 brand-pill rounded-full text-sm font-semibold mb-4">Lokasi PIKR</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Data <span class="brand-text">PIKR</span></h2>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">Pusat Informasi & Konseling Remaja di Berbagai Wilayah</p>
                <div class="w-24 h-1 mx-auto mt-6" style="background-color: var(--brand)"></div>
            </div>
            
            <!-- Search bar -->
            <div class="mb-8 bg-white p-4 rounded-lg shadow-md reveal">
                <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                    <div class="flex-1 mb-4 md:mb-0">
                        <div class="relative">
                            <input type="text" placeholder="Cari PIKR..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-brand focus:border-brand" style="--tw-ring-color: var(--brand); border-color: var(--brand)">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 brand-btn text-white rounded-lg transition-all duration-300" style="background-color: var(--brand); border: 1px solid var(--brand-darker)">
                            Cari
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach(\App\Models\Pikr::take(6)->get() as $pikr)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl reveal">
                    <div class="h-3" style="background-color: var(--brand)"></div>
                    <div class="h-48 flex items-center justify-center" style="background-color: rgba(103,205,242,0.08)">
                        @if($pikr->logo)
                            <img src="{{ asset('storage/' . $pikr->logo) }}" alt="{{ $pikr->name }}" class="h-full w-full object-cover">
                        @else
                            <div class="text-4xl font-bold" style="color: var(--brand)">{{ substr($pikr->name, 0, 2) }}</div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $pikr->name }}</h3>
                            <span class="px-2 py-1 brand-pill text-xs font-semibold rounded-full">Aktif</span>
                        </div>
                        
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($pikr->desc, 100) }}</p>
                        
                        <div class="space-y-3 mb-6">
                            <!-- SK removed and moved to detail page -->
                        </div>
                        
                        <a href="{{ route('pikr.detail', $pikr->id) }}" class="inline-flex items-center px-4 py-2 brand-btn text-white font-medium rounded-lg transition-all duration-300 shadow-md hover:shadow-lg" style="background-color: var(--brand); border: 1px solid var(--brand-darker)">
                            <span>Detail</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12 flex justify-center reveal">
                <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" style="border-color: var(--brand)">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium" style="background-color: rgba(103,205,242,0.08); color: var(--brand); border-color: var(--brand);">1</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </section>

    <!-- Edukasi Section -->
    <section id="edukasi" class="py-16 bg-gradient-to-b from-[#eaf7fd] to-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute top-0 right-0 w-64 h-64 rounded-full opacity-30 transform -translate-x-1/2 -translate-y-1/2" style="background-color: rgba(103,205,242,0.12)"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full opacity-20 transform translate-x-1/3 translate-y-1/3" style="background-color: rgba(103,205,242,0.16)"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal">
                <span class="inline-block px-3 py-1 brand-pill rounded-full text-sm font-semibold mb-4">Pengetahuan</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Materi <span class="brand-text">Edukasi</span></h2>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">Berbagai materi edukasi tentang kesehatan reproduksi, pencegahan pernikahan dini, dan perencanaan kehidupan.</p>
                <div class="w-24 h-1 mx-auto mt-6" style="background-color: var(--brand)"></div>
            </div>
            
            <!-- Category filter -->
            <div class="flex flex-wrap justify-center gap-3 mb-10 reveal">
                @php
                    $selectedKategori = request()->query('kategori');
                    $edukasiQuery = \App\Models\Edukasi::with('kategori');
                    
                    if ($selectedKategori) {
                        $edukasiQuery->where('kategori_edukasi_id', $selectedKategori);
                    }
                    
                    $edukasiList = $edukasiQuery->paginate(6);
                @endphp
                
                <a href="{{ url('#edukasi') }}" class="px-4 py-2 {{ !$selectedKategori ? 'brand-btn text-white' : 'bg-white brand-text border' }} rounded-full transition-all duration-300" style="{{ !$selectedKategori ? 'background-color: var(--brand); border: 1px solid var(--brand-darker)' : 'border-color: var(--brand)' }}">
                    Semua
                </a>
                @foreach(\App\Models\KategoriEdukasi::all() as $kategori)
                <a href="{{ url('#edukasi') . '?kategori=' . $kategori->id }}" class="px-4 py-2 {{ $selectedKategori == $kategori->id ? 'brand-btn text-white' : 'bg-white brand-text border' }} rounded-full transition-all duration-300" style="{{ $selectedKategori == $kategori->id ? 'background-color: var(--brand); border: 1px solid var(--brand-darker)' : 'border-color: var(--brand)' }}">
                    {{ $kategori->name }}
                </a>
                @endforeach
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($edukasiList as $edukasi)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl reveal">
                    <div class="relative h-48 overflow-hidden group">
                        @if($edukasi->cover)
                            <img src="{{ asset('storage/' . $edukasi->cover) }}" alt="{{ $edukasi->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex items-center justify-center transition-all duration-300" style="background-color: rgba(103,205,242,0.08); color: var(--brand)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                            <div class="p-4 w-full">
                                <span class="text-white text-sm">{{ $edukasi->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 brand-pill text-xs font-semibold rounded-full">{{ $edukasi->kategori->name ?? 'Umum' }}</span>
                            <span class="flex items-center text-gray-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ rand(50, 500) }}
                            </span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3 transition-colors duration-300 hover:brand-text">{{ $edukasi->name }}</h3>
                        <p class="text-gray-600 mb-6 line-clamp-3">{{ Str::limit($edukasi->desc, 120) }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold mr-2" style="background-color: rgba(103,205,242,0.16); color: var(--brand)">
                                    A
                                </div>
                                <span class="text-sm text-gray-600">Admin</span>
                            </div>
                            <a href="{{ asset('storage/' . $edukasi->file) }}" class="inline-flex items-center px-4 py-2 brand-btn text-white font-medium rounded-lg transition-all duration-300 shadow-md hover:shadow-lg" style="background-color: var(--brand); border: 1px solid var(--brand-darker)">
                                <span>Baca</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12 flex justify-center reveal">
                {{ $edukasiList->appends(['kategori' => $selectedKategori])->links() }}
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Galeri Kegiatan</h2>
                <div class="mt-2 h-1 w-20 mx-auto" style="background-color: var(--brand)"></div>
                <p class="mt-4 text-gray-600 max-w-3xl mx-auto">
                    Dokumentasi kegiatan PIKR dalam memberikan edukasi dan konseling bagi remaja.
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('img/landing/WhatsApp Image 2025-09-30 at 20.29.46_9f5ea803.jpg') }}" alt="Galeri 1" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('img/landing/WhatsApp Image 2025-09-30 at 20.29.46_d3e6825c.jpg') }}" alt="Galeri 2" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('img/landing/WhatsApp Image 2025-09-30 at 20.29.48_0c0021ae.jpg') }}" alt="Galeri 3" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('img/landing/WhatsApp Image 2025-09-30 at 20.29.49_65f67cb7.jpg') }}" alt="Galeri 4" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('img/landing/WhatsApp Image 2025-09-30 at 20.29.50_1cff76dd.jpg') }}" alt="Galeri 5" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('img/landing/WhatsApp Image 2025-09-30 at 20.29.51_cab62aa2.jpg') }}" alt="Galeri 6" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('img/landing/WhatsApp Image 2025-09-30 at 20.29.51_e873d417.jpg') }}" alt="Galeri 7" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('img/landing/WhatsApp Image 2025-09-30 at 20.29.51_f4e230d4.jpg') }}" alt="Galeri 8" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 brand-gradient text-white relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-20 bg-white opacity-5 transform -skew-y-3"></div>
        <div class="absolute bottom-0 right-0 w-full h-20 bg-white opacity-5 transform skew-y-3"></div>
        <div class="absolute top-1/4 left-10 w-24 h-24 rounded-full opacity-20 animate-pulse" style="background-color: var(--brand)"></div>
        <div class="absolute bottom-1/4 right-10 w-32 h-32 rounded-full opacity-20 animate-float" style="background-color: var(--brand)"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="max-w-3xl mx-auto">
                <span class="inline-block text-sm px-4 py-1 rounded-full mb-4 animate-fadeIn" style="background-color: rgba(255,255,255,0.15); color: #eaf7fd; border: 1px solid rgba(255,255,255,0.3)">Bergabung Bersama Kami</span>
                <h2 class="text-4xl font-bold mb-6 animate-slideInUp">Jadilah Bagian dari <span style="color: #eaf7fd">GENRE</span> Hari Ini</h2>
                <p class="text-lg max-w-2xl mx-auto mb-10 animate-slideInUp" style="color: #eaf7fd">
                    Bergabunglah dalam gerakan untuk membangun masa depan yang lebih baik bagi remaja Indonesia melalui edukasi dan pemberdayaan.
                </p>
                {{-- <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl mb-10 animate-slideInUp">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                        <div class="p-4">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: var(--brand)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Daftar</h3>
                            <p style="color: #eaf7fd">Buat akun dan bergabung dengan komunitas</p>
                        </div>
                        <div class="p-4">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: var(--brand)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Belajar</h3>
                            <p style="color: #eaf7fd">Akses materi edukasi berkualitas</p>
                        </div>
                        <div class="p-4">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: var(--brand)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Berbagi</h3>
                            <p style="color: #eaf7fd">Bagikan pengetahuan dengan teman</p>
                        </div>
                    </div>
                </div> --}}
                {{-- <a href="#" class="font-bold py-4 px-10 rounded-lg transition duration-300 inline-flex items-center hover-lift animate-pulse brand-btn text-white" style="background-color: var(--brand); border: 1px solid var(--brand-darker)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Daftar Sekarang
                </a> --}}
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="brand-gradient text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div class="animate-fadeIn">
                    <div class="flex items-center mb-6">
                        <img src="{{ asset('img/maskot.png') }}" alt="GENRE Logo" class="h-10 w-auto mr-3">
                        <h3 class="text-white text-xl font-bold">GENRE</h3>
                    </div>
                    <p class="mb-6" style="color: #eaf7fd">Generasi Berencana untuk masa depan yang lebih baik melalui edukasi dan pemberdayaan remaja Indonesia.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition duration-300 hover:opacity-90" style="background-color: rgba(255,255,255,0.15); color: #eaf7fd; border: 1px solid rgba(255,255,255,0.3)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition duration-300 hover:opacity-90" style="background-color: rgba(255,255,255,0.15); color: #eaf7fd; border: 1px solid rgba(255,255,255,0.3)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition duration-300 hover:opacity-90" style="background-color: rgba(255,255,255,0.15); color: #eaf7fd; border: 1px solid rgba(255,255,255,0.3)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="animate-fadeIn" style="animation-delay: 0.2s">
                    <h3 class="text-white text-lg font-bold mb-6 border-b pb-2" style="border-color: rgba(255,255,255,0.3)">Tautan Cepat</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#beranda" class="hover:text-white transition duration-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #eaf7fd">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#tentang" class="hover:text-white transition duration-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #eaf7fd">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="#pikr" class="hover:text-white transition duration-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #eaf7fd">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                PIKR
                            </a>
                        </li>
                        <li>
                            <a href="#edukasi" class="hover:text-white transition duration-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #eaf7fd">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                Edukasi
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="animate-fadeIn" style="animation-delay: 0.4s">
                    <h3 class="text-white text-lg font-bold mb-6 border-b pb-2" style="border-color: rgba(255,255,255,0.3)">Kontak Kami</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #eaf7fd">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>genregorut@gmail.com</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #eaf7fd">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>genre.gorontaloutara</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #eaf7fd">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Molingkapoto, Kec. Kwandang, Kabupaten Gorontalo
 Utara, Gorontalo 96252
</span>
                        </li>
                    </ul>
                </div>
                {{-- <div class="animate-fadeIn" style="animation-delay: 0.6s">
                    <h3 class="text-white text-lg font-bold mb-6 border-b pb-2" style="border-color: rgba(255,255,255,0.3)">Berlangganan</h3>
                    <p class="mb-6" style="color: #eaf7fd">Dapatkan informasi terbaru dari kami langsung ke email Anda.</p>
                    <form class="mb-4">
                        <div class="flex flex-col space-y-3">
                            <input type="email" placeholder="Email Anda" class="px-4 py-3 rounded-lg w-full focus:outline-none bg-white/90 text-gray-900 border focus:ring-2" style="--tw-ring-color: var(--brand); border-color: rgba(255,255,255,0.3)">
                            <button type="submit" class="px-4 py-3 rounded-lg text-white font-medium transition duration-300 flex items-center justify-center hover-lift brand-btn" style="background-color: var(--brand); border: 1px solid var(--brand-darker)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                Berlangganan
                            </button>
                        </div>
                    </form>
                    <p class="text-xs" style="color: #eaf7fd">Kami tidak akan pernah membagikan email Anda kepada pihak lain.</p>
                </div> --}}
            </div>
            <div class="border-t mt-12 pt-8 text-center" style="border-color: rgba(255,255,255,0.3)">
                <p style="color: #eaf7fd">&copy; {{ date('Y') }} GENRE. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for Mobile Menu Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking on a link
            const mobileMenuLinks = document.querySelectorAll('.mobile-menu a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Función para revelar elementos al hacer scroll
            function revealOnScroll() {
                const reveals = document.querySelectorAll('.reveal');
                
                for (let i = 0; i < reveals.length; i++) {
                    const windowHeight = window.innerHeight;
                    const elementTop = reveals[i].getBoundingClientRect().top;
                    const elementVisible = 150;
                    
                    if (elementTop < windowHeight - elementVisible) {
                        reveals[i].classList.add('active');
                    } else {
                        reveals[i].classList.remove('active');
                    }
                }
            }
            
            // Añadir event listener para scroll
            window.addEventListener('scroll', revealOnScroll);
            
            // Ejecutar al cargar la página
            revealOnScroll();
        });
    </script>
</body>
</html>
