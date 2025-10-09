<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pikr->name }} - {{ config('app.name', 'Laravel') }}</title>
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
    <!-- Header PIKR -->
    <div class="relative h-48 bg-elephant-600">
        <div class="absolute inset-0 bg-gradient-to-r from-elephant-800 to-elephant-500 opacity-90"></div>
        <div class="absolute inset-0 flex items-center px-8">
            <div class="flex items-center space-x-6">
                <div class="h-24 w-24 bg-white rounded-lg shadow-lg overflow-hidden flex items-center justify-center">
                    @if($pikr->logo)
                        <img src="{{ asset('storage/' . $pikr->logo) }}" alt="{{ $pikr->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="text-elephant-500 text-4xl font-bold">{{ substr($pikr->name, 0, 2) }}</div>
                    @endif
                </div>
                <div>
                    <div class="text-white text-xs font-semibold uppercase tracking-wider mb-1">PIKR</div>
                    <h1 class="text-white text-3xl font-bold">{{ $pikr->name }}</h1>
                    <div class="mt-2 flex items-center">
                        <span class="px-2 py-1 bg-white text-elephant-800 text-xs font-semibold rounded-full">Aktif</span>
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
            <p class="text-gray-600">{{ $pikr->desc }}</p>
            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-elephant-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>SK: {{ Str::limit($pikr->sk, 30) }}</span>
                    </div>
                    <a href="{{ asset('storage/' . $pikr->sk) }}" download class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-elephant-600 hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div x-data="{ activeTab: 'struktur' }">
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button @click="activeTab = 'struktur'" :class="{ 'border-elephant-500 text-elephant-600': activeTab === 'struktur', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'struktur' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Struktur Organisasi
                    </button>
                    <button @click="activeTab = 'anggota'" :class="{ 'border-elephant-500 text-elephant-600': activeTab === 'anggota', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'anggota' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Anggota
                    </button>
                    <button @click="activeTab = 'prestasi'" :class="{ 'border-elephant-500 text-elephant-600': activeTab === 'prestasi', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'prestasi' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Prestasi
                    </button>
                    <button @click="activeTab = 'kegiatan'" :class="{ 'border-elephant-500 text-elephant-600': activeTab === 'kegiatan', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'kegiatan' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Jadwal Kegiatan
                    </button>
                </nav>
            </div>

            <!-- Struktur Organisasi Tab -->
            <div x-show="activeTab === 'struktur'">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Struktur Organisasi</h3>
                
                @if($jabatan->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($jabatan as $jbt)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="p-5">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $jbt->nama }}</h4>
                            <p class="mt-2 text-gray-600">{{ $jbt->deskripsi }}</p>
                            
                            @if($jbt->anggota)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-elephant-100 flex items-center justify-center text-elephant-600 font-semibold">
                                            {{ substr($jbt->anggota->nama, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $jbt->anggota->nama }}</p>
                                        <p class="text-xs text-gray-500">Sejak {{ \Carbon\Carbon::parse($jbt->created_at)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-sm text-gray-500 italic">Belum ada anggota</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-gray-500">Belum ada data struktur organisasi</p>
                </div>
                @endif
            </div>

            <!-- Anggota Tab -->
            <div x-show="activeTab === 'anggota'" class="hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Anggota</h3>
                
                @if($anggota->count() > 0)
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Nama</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Jabatan</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Jenis Kelamin</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tanggal Lahir</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($anggota as $agt)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">{{ $agt->nama }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if($agt->jabatan)
                                        {{ $agt->jabatan->nama }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $agt->jenis_kelamin }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($agt->tanggal_lahir)->format('d M Y') }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $agt->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $agt->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-gray-500">Belum ada data anggota</p>
                </div>
                @endif
            </div>

            <!-- Prestasi Tab -->
            <div x-show="activeTab === 'prestasi'" class="hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Prestasi Anggota</h3>
                
                @if($prestasi->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($prestasi as $pres)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <h4 class="text-lg font-semibold text-gray-900">{{ $pres->nama_prestasi }}</h4>
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">{{ $pres->tingkat }}</span>
                            </div>
                            <p class="mt-2 text-gray-600">{{ $pres->deskripsi }}</p>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-elephant-100 flex items-center justify-center text-elephant-600 font-semibold">
                                            {{ substr($pres->anggota->nama, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $pres->anggota->nama }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($pres->tanggal)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-gray-500">Belum ada data prestasi</p>
                </div>
                @endif
            </div>

            <!-- Kegiatan Tab -->
            <div x-show="activeTab === 'kegiatan'" class="hidden">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Jadwal Kegiatan</h3>
                
                @if($kegiatan->count() > 0)
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Nama Kegiatan</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tanggal</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Lokasi</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($kegiatan as $keg)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">{{ $keg->nama }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($keg->tanggal)->format('d M Y') }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $keg->lokasi }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @php
                                        $now = \Carbon\Carbon::now();
                                        $kegDate = \Carbon\Carbon::parse($keg->tanggal);
                                        $status = $now->gt($kegDate) ? 'Selesai' : 'Akan Datang';
                                        $statusClass = $now->gt($kegDate) ? 'bg-gray-100 text-gray-800' : 'bg-blue-100 text-blue-800';
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                        {{ $status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-gray-500">Belum ada jadwal kegiatan</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
    </main>
    
    <script>
        document.addEventListener('alpine:init', () => {
            // Inisialisasi Alpine.js
        });
    </script>
</body>
</html>