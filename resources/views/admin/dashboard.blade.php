@extends('layouts.app', ['title' => 'Admin Dashboard'])

@section('content')

            <!-- Welcome Card -->
            <div class="mb-6">
                <x-card>
                    <div class="text-center">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            🛡️ Admin Dashboard
                        </h1>
                        <p class="text-gray-600 mb-6">
                            Selamat datang di panel admin. 
                            @if($user->hasRole('admin_pikr'))
                                Anda memiliki akses ke pengelolaan PIKR.
                            @else
                                Anda memiliki akses penuh ke sistem.
                            @endif
                        </p>
                        
                        <!-- Admin Info -->
                        <div class="bg-gradient-to-r from-primary-50 to-success-50 rounded-lg p-4 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Informasi Administrator</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-700">Nama:</span>
                                    <span class="text-gray-900">{{ $user->name }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Email:</span>
                                    <span class="text-gray-900">{{ $user->email }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Role:</span>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-danger-100 text-danger-800">
                                        {{ $user->getRoleNames()->first() ?? 'Admin' }}
                                    </span>
                                </div>
                                @if($user->hasRole('admin_pikr') && isset($user->pikr))
                                <div>
                                    <span class="font-medium text-gray-700">PIKR:</span>
                                    <span class="text-gray-900">{{ $user->pikr->name }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                            <!-- Tabel Artikel Terverifikasi -->
                        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Artikel </h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">PIKR</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Dibuat</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $unverifiedArtikels = \App\Models\Artikel::where('isVerified', false)
                                                ->with('pikr')
                                                ->orderBy('created_at', 'desc')
                                                ->take(5)
                                                ->get();
                                        @endphp
                                        
                                        @forelse($unverifiedArtikels as $artikel)
                                            <tr>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $artikel->title }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $artikel->pikr->name ?? 'Tidak ada PIKR' }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $artikel->created_at->format('d M Y') }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    <a href="{{ route('artikel.show', $artikel) }}" class="text-blue-600 hover:text-blue-800 mr-3">Lihat</a>
                                                    @if(auth()->user()->getRoleNames()[0] === 'admin')
                                                    <form action="{{ route('master.artikel.verify', $artikel->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-green-600 hover:text-green-800" title="Verifikasi Artikel">
                                                            Verifikasi
                                                        </button>
                                                    </form>
                                                    @endif
                                                    @if(auth()->user()->getRoleNames()[0] === 'admin' && !$artikel->isVerified)
                                                    <form action="{{ route('master.artikel.reject', $artikel->id) }}" method="POST" class="inline ml-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="text" name="msg" class="text-sm border rounded px-2 py-1" placeholder="Alasan penolakan" required>
                                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Tolak Artikel">
                                                            Tolak
                                                        </button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="py-4 px-4 border-b border-gray-200 text-center text-gray-500">Tidak ada artikel belum terverifikasi</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4 text-right">
                                {{-- <a href="{{ route('master.artikel.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua Artikel</a> --}}
                            </div>
                        </div>

                        @if($user->hasRole('admin_bkbn'))
                        <!-- Admin BKBN Stats -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <x-card>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-primary-600">
                                        {{ \App\Models\Pikr::count() }}
                                    </div>
                                    <div class="text-sm text-gray-600">Total PIKR</div>
                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-primary-600 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </x-card>
                            
                            <x-card>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-success-600">
                                        {{ \App\Models\Anggota::count() }}
                                    </div>
                                    <div class="text-sm text-gray-600">Total Anggota</div>
                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-success-600 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </x-card>
                            
                            <x-card>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-warning-600">
                                        {{ \App\Models\Kegiatan::count() }}
                                    </div>
                                    <div class="text-sm text-gray-600">Total Kegiatan</div>
                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-warning-600 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </x-card>
                            
                            <x-card>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-amber-600">
                                        {{ \App\Models\Artikel::count() }}
                                    </div>
                                    <div class="text-sm text-gray-600">Total Artikel</div>
                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-amber-600 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </x-card>
                        </div>
                        
                        <!-- Admin BKBN Actions -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <x-button href="{{ route('welcome') }}" variant="ghost" size="lg" class="w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Lihat Website
                            </x-button>
                            {{-- <x-button href="{{ route('master.pikr.index') }}" variant="primary" size="lg" class="w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Lihat Data PIKR
                            </x-button> --}}
                            <x-button href="{{ route('admin.laporan') }}" variant="success" size="lg" class="w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Cetak Laporan
                            </x-button>
                        </div>
                        
                        <!-- Laporan Section -->
                        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Laporan Tersedia</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <a href="{{ route('admin.laporan.pikr') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 p-3 rounded-full mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Laporan PIKR</h4>
                                            <p class="text-sm text-gray-600">Data lengkap PIKR</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="{{ route('admin.laporan.anggota') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="bg-green-100 p-3 rounded-full mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Laporan Anggota</h4>
                                            <p class="text-sm text-gray-600">Data anggota per PIKR</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="{{ route('admin.laporan.kegiatan') }}" class="block p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="bg-yellow-100 p-3 rounded-full mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Laporan Kegiatan</h4>
                                            <p class="text-sm text-gray-600">Data kegiatan per PIKR</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                    
                        
                        @elseif(!$user->hasRole('admin_pikr'))
                        <!-- Admin Stats -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <x-card>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-primary-600">
                                        {{ \App\Models\Pikr::count() }}
                                    </div>
                                    <div class="text-sm text-gray-600">Total PIKR</div>
                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-primary-600 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </x-card>
                            
                            <x-card>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-success-600">
                                        {{ \App\Models\User::count() }}
                                    </div>
                                    <div class="text-sm text-gray-600">Total Pengguna</div>
                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-success-600 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </x-card>
                            
                            <x-card>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-warning-600">
                                        {{ \App\Models\Kegiatan::count() }}
                                    </div>
                                    <div class="text-sm text-gray-600">Total Kegiatan</div>
                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-warning-600 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </x-card>
                            
                            <x-card>
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-amber-600">
                                        {{ \App\Models\Artikel::count() }}
                                    </div>
                                    <div class="text-sm text-gray-600">Total Artikel</div>
                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-amber-600 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </x-card>
                        </div>
                        
                        <!-- Admin Actions -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-button href="{{ route('welcome') }}" variant="ghost" size="lg" class="w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Lihat Website
                            </x-button>
                            <x-button href="{{ route('master.pikr.index') }}" variant="primary" size="lg" class="w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Kelola PIKR
                            </x-button>
                        </div>
                        @else
                        <!-- PIKR Admin Actions -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <x-button href="{{ route('master.pikr.show', $user->pikr->id ?? 0) }}" variant="primary" size="lg" class="w-full">
                                Detail PIKR
                            </x-button>
                            <x-button href="{{ route('master.anggota.index', $user->pikr->id ?? 0) }}" variant="success" size="lg" class="w-full">
                                Kelola Anggota
                            </x-button>
                            <x-button href="{{ route('master.kegiatan.index', $user->pikr->id ?? 0) }}" variant="warning" size="lg" class="w-full">
                                Kelola Kegiatan
                            </x-button>
                            <x-button href="{{ route('master.jabatan.index', $user->pikr->id ?? 0) }}" variant="info" size="lg" class="w-full">
                                Struktur Organisasi
                            </x-button>
                        </div>
                        @endif
                    </div>
                </x-card>
            </div>

            @if($user->hasRole('admin_pikr'))
            <!-- PIKR Info -->
            @php
                // Cari PIKR berdasarkan user_id
                $pikr = \App\Models\Pikr::where('user_id', $user->id)->first();
                
                // Hitung statistik tambahan
                $maleCount = \App\Models\Anggota::where('pikr_id', $pikr->id ?? 0)->where('gender', 'L')->count();
                $femaleCount = \App\Models\Anggota::where('pikr_id', $pikr->id ?? 0)->where('gender', 'P')->count();
                $recentActivities = \App\Models\Kegiatan::where('pikr_id', $pikr->id ?? 0)->orderBy('created_at', 'desc')->take(3)->get();
                $verifiedActivities = \App\Models\Kegiatan::where('pikr_id', $pikr->id ?? 0)
                    ->whereHas('laporanKegiatan', function($query) {
                        $query->where('isVerified', true);
                    })->count();
                $pendingActivities = \App\Models\Kegiatan::where('pikr_id', $pikr->id ?? 0)
                    ->whereHas('laporanKegiatan', function($query) {
                        $query->where('isVerified', false);
                    })->count();
            @endphp
            
            @if($pikr)
            <div class="mb-6">
                <x-card>
                    <x-slot name="header">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi PIKR</h3>
                            <a href="{{ route('master.pikr.edit', $pikr->id) }}" class="px-3 py-1.5 text-sm font-medium text-white bg-elephant-600 border border-transparent rounded-md shadow-sm hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                                <i class="fas fa-edit mr-1"></i> Edit PIKR
                            </a>
                        </div>
                    </x-slot>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Deskripsi PIKR:</h4>
                            <p class="text-gray-800">{{ $pikr->desc ?? 'Tidak ada deskripsi' }}</p>
                            
                            <div class="mt-4">
                                <h4 class="font-medium text-gray-700 mb-2">Informasi Kontak:</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span>{{ $pikr->phone ?? 'Belum diisi' }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $pikr->email ?? 'Belum diisi' }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>{{ $pikr->address ?? 'Belum diisi' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            @if($pikr->logo)
                            <div class="mb-4">
                                <h4 class="font-medium text-gray-700 mb-2">Logo PIKR:</h4>
                                <img src="{{ asset('storage/' . $pikr->logo) }}" alt="Logo PIKR" class="h-32 object-contain">
                            </div>
                            @endif
                            
                            @if($pikr->sk)
                            <div class="mb-4">
                                <h4 class="font-medium text-gray-700 mb-2">SK PIKR:</h4>
                                <a href="{{ asset('storage/' . $pikr->sk) }}" target="_blank" class="text-blue-500 hover:underline flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Lihat SK PIKR
                                </a>
                            </div>
                            @endif
                            
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">Status PIKR:</h4>
                                <div class="flex items-center">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $pikr->is_active ? 'bg-success-100 text-success-800' : 'bg-danger-100 text-danger-800' }}">
                                        {{ $pikr->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                    <span class="ml-2 text-sm text-gray-600">Terakhir diperbarui: {{ $pikr->updated_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>
            @endif
            
            <!-- PIKR Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <x-card>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary-600">
                            {{ \App\Models\Anggota::where('pikr_id', $pikr->id)->count() }}
                        </div>
                        <div class="text-sm text-gray-600">Total Anggota</div>
                        <div class="mt-2 flex justify-center space-x-2">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">L: {{ $maleCount }}</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-pink-100 text-pink-800">P: {{ $femaleCount }}</span>
                        </div>
                        @php
                            $totalAnggota = \App\Models\Anggota::where('pikr_id', $pikr->id)->count();
                            $malePercentage = $totalAnggota > 0 ? ($maleCount / $totalAnggota) * 100 : 0;
                            $femalePercentage = $totalAnggota > 0 ? ($femaleCount / $totalAnggota) * 100 : 0;
                        @endphp
                        <div class="mt-2">
                            <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-blue-600 h-2.5 float-left" style="width: {{ $malePercentage }}%"></div>
                                <div class="bg-pink-600 h-2.5 float-left" style="width: {{ $femalePercentage }}%"></div>
                            </div>
                        </div>
                    </div>
                </x-card>
                
                <x-card>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-success-600">
                            {{ \App\Models\Kegiatan::where('pikr_id', $pikr->id)->count() }}
                        </div>
                        <div class="text-sm text-gray-600">Total Kegiatan</div>
                        <div class="mt-2 flex justify-center space-x-2">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Terverifikasi: {{ $verifiedActivities }}</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending: {{ $pendingActivities }}</span>
                        </div>
                    </div>
                </x-card>
                
                <x-card>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-warning-600">
                            {{ \App\Models\Jabatan::where('pikr_id', $pikr->id)->count() }}
                        </div>
                        <div class="text-sm text-gray-600">Struktur Organisasi</div>
                        <div class="mt-2">
                            <a href="{{ route('master.jabatan.index', $pikr->id) }}" class="text-xs text-blue-600 hover:underline">Lihat struktur</a>
                        </div>
                    </div>
                </x-card>
                
                <x-card>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-amber-600">
                            {{ \App\Models\Artikel::where('pikr_id', $pikr->id)->count() }}
                        </div>
                        <div class="text-sm text-gray-600">Total Artikel</div>
                        <div class="mt-2">
                            <a href="{{ route('master.artikel.index', ['pikr_id' => $pikr->id]) }}" class="text-xs text-blue-600 hover:underline">Kelola artikel</a>
                        </div>
                    </div>
                </x-card>
            </div>
            
            <!-- Aktivitas Terbaru -->
            <div class="mb-6">
                <x-card>
                    <x-slot name="header">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                            <a href="{{ route('master.kegiatan.index', $pikr->id) }}" class="text-sm text-blue-600 hover:underline">Lihat semua</a>
                        </div>
                    </x-slot>
                    
                    @if($recentActivities->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentActivities as $activity)
                                <div class="border-b border-gray-200 pb-3 last:border-0 last:pb-0">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $activity->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ Str::limit($activity->desc, 100) }}</p>
                                            <div class="mt-1 flex items-center space-x-4 text-xs">
                                                <span class="text-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($activity->date)->format('d M Y') }}
                                                </span>
                                                <span class="text-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    {{ $activity->location }}
                                                </span>
                                                @if($activity->laporanKegiatan)
                                                    <span class="inline-flex px-2 py-0.5 rounded-full {{ $activity->laporanKegiatan->isVerified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ $activity->laporanKegiatan->isVerified ? 'Terverifikasi' : 'Belum Verifikasi' }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex px-2 py-0.5 rounded-full bg-red-100 text-red-800">
                                                        Belum Ada Laporan
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="{{ route('master.kegiatan.show', $activity->id) }}" class="px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-md hover:bg-blue-200">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-gray-500">
                            Belum ada aktivitas terbaru
                        </div>
                    @endif
                </x-card>
            </div>
            
            <!-- PIKR Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <x-button href="{{ route('master.pikr.show', $user->pikr->id ?? 0) }}" variant="primary" size="lg" class="w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Detail PIKR
                </x-button>
                <x-button href="{{ route('master.anggota.index', $user->pikr->id ?? 0) }}" variant="success" size="lg" class="w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Kelola Anggota
                </x-button>
                <x-button href="{{ route('master.kegiatan.index', $user->pikr->id ?? 0) }}" variant="warning" size="lg" class="w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Kelola Kegiatan
                </x-button>
                <x-button href="{{ route('master.artikel.index', ['pikr_id' => $user->pikr->id ?? 0]) }}" variant="amber" size="lg" class="w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Kelola Artikel
                </x-button>
            </div>
            @endif
@endsection