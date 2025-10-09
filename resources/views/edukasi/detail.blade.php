<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $edukasi->name }} - {{ config('app.name', 'Laravel') }}</title>
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
                    <a href="{{ url('/#edukasi') }}" class="text-gray-600 hover:text-elephant-600 px-3 py-2 rounded-md text-sm font-medium">Kembali ke Materi Edukasi</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Header Edukasi -->
            <div class="relative h-48 bg-elephant-600">
                <div class="absolute inset-0 bg-gradient-to-r from-elephant-800 to-elephant-500 opacity-90"></div>
                <div class="absolute inset-0 flex items-center px-8">
                    <div class="flex items-center space-x-6">
                        <div class="h-24 w-24 bg-white rounded-lg shadow-lg overflow-hidden flex items-center justify-center">
                            @if($edukasi->cover)
                                <img src="{{ asset('storage/' . $edukasi->cover) }}" alt="{{ $edukasi->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="text-elephant-500 text-4xl font-bold">{{ substr($edukasi->name, 0, 2) }}</div>
                            @endif
                        </div>
                        <div>
                            <div class="text-white text-xs font-semibold uppercase tracking-wider mb-1">MATERI EDUKASI</div>
                            <h1 class="text-white text-3xl font-bold">{{ $edukasi->name }}</h1>
                            <div class="mt-2 flex items-center">
                                <span class="px-2 py-1 bg-white text-elephant-800 text-xs font-semibold rounded-full">{{ $edukasi->kategori->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Deskripsi -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi</h2>
                    <p class="text-gray-600">{{ $edukasi->desc }}</p>
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-elephant-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Kategori: {{ $edukasi->kategori->name }}</span>
                            </div>
                            <a href="{{ asset('storage/' . $edukasi->file) }}" target="_blank" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-elephant-600 hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat Materi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Material Content -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Materi</h2>
                    
                    @php
                        $fileExtension = pathinfo($edukasi->file, PATHINFO_EXTENSION);
                    @endphp
                    
                    @if(in_array(strtolower($fileExtension), ['pdf']))
                        <div class="bg-gray-100 rounded-lg p-4 mb-4">
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe src="{{ asset('storage/' . $edukasi->file) }}" class="w-full h-full rounded-lg" style="height: 500px;"></iframe>
                            </div>
                        </div>
                    @elseif(in_array(strtolower($fileExtension), ['mp4', 'avi', 'mov', 'wmv']))
                        <div class="bg-gray-100 rounded-lg p-4 mb-4">
                            <div class="aspect-w-16 aspect-h-9">
                                <video controls class="w-full h-full rounded-lg">
                                    <source src="{{ asset('storage/' . $edukasi->file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-6 text-center">
                            <p class="text-gray-500">Materi tidak dapat ditampilkan langsung. Silakan unduh untuk melihat.</p>
                            <a href="{{ asset('storage/' . $edukasi->file) }}" download class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-elephant-600 hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download Materi
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Related Materials -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Materi Terkait</h2>
                    
                    @php
                        $relatedMaterials = \App\Models\Edukasi::where('kategori_edukasi_id', $edukasi->kategori_edukasi_id)
                            ->where('id', '!=', $edukasi->id)
                            ->take(3)
                            ->get();
                    @endphp
                    
                    @if($relatedMaterials->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedMaterials as $related)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <div class="h-40 bg-elephant-100 overflow-hidden">
                                @if($related->cover)
                                    <img src="{{ asset('storage/' . $related->cover) }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-elephant-100 text-elephant-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $related->name }}</h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($related->desc, 100) }}</p>
                                <a href="{{ route('edukasi.detail', $related->id) }}" class="text-elephant-600 hover:text-elephant-800 font-medium text-sm inline-flex items-center">
                                    Lihat Materi
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="bg-gray-50 rounded-lg p-6 text-center">
                        <p class="text-gray-500">Tidak ada materi terkait</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    
    <script>
        document.addEventListener('alpine:init', () => {
            // Inisialisasi Alpine.js jika diperlukan
        });
    </script>
</body>
</html>