<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $artikel->title }} - {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ url('/') }}" class="text-elephant-600 font-bold text-xl">GENRE</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-elephant-600 px-3 py-2 rounded-md text-sm font-medium">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Header Artikel -->
            <div class="relative h-48 bg-elephant-600">
                <div class="absolute inset-0 bg-gradient-to-r from-elephant-800 to-elephant-500 opacity-90"></div>
                <div class="absolute inset-0 flex items-center px-8">
                    <div>
                        <div class="text-white text-xs font-semibold uppercase tracking-wider mb-1">Artikel</div>
                        <h1 class="text-white text-3xl font-bold">{{ $artikel->title }}</h1>
                        <div class="mt-2 flex items-center">
                            <span class="px-2 py-1 bg-white text-elephant-800 text-xs font-semibold rounded-full">
                                {{ $artikel->pikr->name }}
                            </span>
                            <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                {{ $artikel->isVerified ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                            </span>
                            <span class="ml-2 text-white text-sm">
                                {{ $artikel->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Cover Image -->
                @if($artikel->cover)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $artikel->cover) }}" alt="{{ $artikel->title }}" class="w-full h-auto rounded-lg shadow-md">
                </div>
                @endif

                <!-- Konten Artikel -->
                <div class="prose max-w-none">
                    {!! $artikel->content !!}
                </div>

                <!-- Info PIKR -->
                <div class="mt-10 pt-6 border-t border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Tentang PIKR</h3>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="h-16 w-16 bg-elephant-100 rounded-lg shadow-sm overflow-hidden flex items-center justify-center mr-4">
                                @if($artikel->pikr->logo)
                                    <img src="{{ asset('storage/' . $artikel->pikr->logo) }}" alt="{{ $artikel->pikr->name }}" class="h-full w-full object-cover">
                                @else
                                    <div class="text-elephant-500 text-2xl font-bold">{{ substr($artikel->pikr->name, 0, 2) }}</div>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">{{ $artikel->pikr->name }}</h4>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($artikel->pikr->desc, 100) }}</p>
                                <a href="{{ route('pikr.detail', $artikel->pikr->id) }}" class="inline-flex items-center mt-2 text-sm text-elephant-600 hover:text-elephant-800">
                                    <span>Lihat Profil PIKR</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Artikel Terkait -->
                @php
                $relatedArticles = \App\Models\Artikel::where('pikr_id', $artikel->pikr_id)
                    ->where('id', '!=', $artikel->id)
                    ->where('isVerified', true)
                    ->latest()
                    ->take(3)
                    ->get();
                @endphp

                @if($relatedArticles->count() > 0)
                <div class="mt-10">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Artikel Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedArticles as $relatedArticle)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <div class="h-40 bg-gray-100">
                                @if($relatedArticle->cover)
                                    <img src="{{ asset('storage/' . $relatedArticle->cover) }}" alt="{{ $relatedArticle->title }}" class="h-full w-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full w-full bg-elephant-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-elephant-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1M19 20a2 2 0 002-2V8a2 2 0 00-2-2h-5M8 12h.01M12 12h.01M16 12h.01M8 16h.01M12 16h.01M16 16h.01" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ Str::limit($relatedArticle->title, 50) }}</h4>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">{{ $relatedArticle->created_at->format('d M Y') }}</span>
                                    <a href="{{ route('artikel.show', $relatedArticle->id) }}" class="text-sm text-elephant-600 hover:text-elephant-800">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </main>
    
    <footer class="bg-gray-100 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} GENRE - Generasi Berencana. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>