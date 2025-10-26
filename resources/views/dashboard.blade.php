@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
<!-- Welcome Card -->
<div class="mb-6">
    <x-card class="bg-gradient-to-br from-elephant-50 to-white border-0 shadow-lg">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-elephant-800 mb-4">
                @if($user->hasRole('admin_bkbn'))
                    Dashboard Admin BKBN
                @else
                    Selamat Datang di Dashboard
                @endif
            </h1>
            
            @if($user->hasRole('admin_pikr'))
                <p class="text-elephant-600 mb-6">
                    Anda berhasil login sebagai admin PIKR. Ini adalah dashboard Anda.
                </p>
                
                <!-- PIKR Info -->
                @php
                    // Cari PIKR berdasarkan user_id
                    $pikr = $user->pikr;
                @endphp
                
                @if($pikr)
                <div class="mb-6">
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6 mb-6 border border-elephant-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-semibold text-elephant-800">
                                <i class="fas fa-info-circle text-elephant-600 mr-2"></i>Informasi PIKR
                            </h3>
                            <a href="{{ route('master.pikr.edit', $pikr->id) }}" class="px-3 py-1.5 text-sm font-medium text-elephant-50 bg-elephant-600 border border-transparent rounded-md shadow-sm hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500 transition-all duration-200 transform hover:scale-105">
                                <i class="fas fa-edit mr-1"></i> Edit PIKR
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-elephant-700 mb-2">Nama PIKR:</h4>
                                <p class="text-elephant-800 bg-elephant-50 p-2 rounded-md">{{ $pikr->name }}</p>
                                
                                <h4 class="font-medium text-elephant-700 mt-4 mb-2">Deskripsi PIKR:</h4>
                                <p class="text-elephant-800 bg-elephant-50 p-2 rounded-md">{{ $pikr->desc ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                            
                            <div>
                                @if($pikr->logo)
                                <div class="mb-4">
                                    <h4 class="font-medium text-elephant-700 mb-2">Logo PIKR:</h4>
                                    <div class="bg-elephant-50 p-2 rounded-md flex justify-center">
                                        <img src="{{ asset('storage/' . $pikr->logo) }}" alt="Logo PIKR" class="h-32 object-contain shadow-sm hover:shadow-md transition-shadow duration-300">
                                    </div>
                                </div>
                                @endif
                                
                                @if($pikr->sk)
                                <div>
                                    <h4 class="font-medium text-elephant-700 mb-2">SK PIKR:</h4>
                                    <div class="bg-elephant-50 p-2 rounded-md">
                                        <a href="{{ asset('storage/' . $pikr->sk) }}" target="_blank" class="text-elephant-600 hover:text-elephant-800 hover:underline flex items-center">
                                            <i class="fas fa-file-pdf text-elephant-500 mr-2"></i> Lihat SK PIKR
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- PIKR Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 border-t-4 border-primary-500">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-primary-600 flex justify-center items-center">
                                    <i class="fas fa-users text-primary-400 mr-2"></i>
                                    {{ \App\Models\Anggota::where('pikr_id', $pikr->id)->count() }}
                                </div>
                                <div class="text-sm text-elephant-600 font-medium mt-2">Total Anggota</div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 border-t-4 border-success-500">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-success-600 flex justify-center items-center">
                                    <i class="fas fa-calendar-check text-success-400 mr-2"></i>
                                    {{ \App\Models\Kegiatan::where('pikr_id', $pikr->id)->count() }}
                                </div>
                                <div class="text-sm text-elephant-600 font-medium mt-2">Total Kegiatan</div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 border-t-4 border-warning-500">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-warning-600 flex justify-center items-center">
                                    <i class="fas fa-sitemap text-warning-400 mr-2"></i>
                                    {{ \App\Models\Jabatan::where('pikr_id', $pikr->id)->count() }}
                                </div>
                                <div class="text-sm text-elephant-600 font-medium mt-2">Struktur Organisasi</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- PIKR Actions -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <a href="{{ route('master.anggota.index', ['pikr_id' => $pikr->id]) }}" class="px-4 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-black font-medium rounded-md text-center hover:from-primary-600 hover:to-primary-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-users mr-2"></i> Kelola Anggota
                        </a>
                        <a href="{{ route('master.kegiatan.index', ['pikr_id' => $pikr->id]) }}" class="px-4 py-3 bg-gradient-to-r from-success-500 to-success-600 text-black font-medium rounded-md text-center hover:from-success-600 hover:to-success-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-calendar-alt mr-2"></i> Kelola Kegiatan
                        </a>
                        <a href="{{ route('master.jabatan.index', ['pikr_id' => $pikr->id]) }}" class="px-4 py-3 bg-gradient-to-r from-warning-500 to-warning-600 text-black font-medium rounded-md text-center hover:from-warning-600 hover:to-warning-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-sitemap mr-2"></i> Struktur Organisasi
                        </a>
                        <a href="{{ route('master.artikel.index', ['pikr_id' => $pikr->id]) }}" class="px-4 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-black font-medium rounded-md text-center hover:from-amber-600 hover:to-amber-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-newspaper mr-2"></i> Kelola Artikel
                        </a>
                    </div>
                </div>
                @else
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-r-md shadow-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-elephant-700">
                                Anda memiliki role admin_pikr tetapi belum memiliki PIKR yang terkait. Silakan hubungi administrator.
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            @elseif($user->hasRole('admin_bkbn'))
                <!-- Tampilan khusus untuk admin_bkbn -->
                <div class="mb-6">
                    <!-- Tombol Aksi untuk admin_bkbn -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <a href="{{ route('welcome') }}" class="px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-md text-center hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-globe mr-2"></i> Lihat Website
                        </a>
                        <a href="#" class="px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-medium rounded-md text-center hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-print mr-2"></i> Cetak Laporan
                        </a>
                    </div>
                </div>
            @else
                <p class="text-elephant-600 mb-6">
                    Anda berhasil login sebagai pengguna biasa. Ini adalah dashboard Anda.
                </p>
            @endif
            
            <!-- User Info -->
            <div class="bg-gradient-to-r from-elephant-50 to-white rounded-lg p-5 mb-6 shadow-md hover:shadow-lg transition-shadow duration-300 border border-elephant-100">
                <h3 class="text-lg font-semibold text-elephant-800 mb-3 flex items-center">
                    <i class="fas fa-user-circle text-elephant-600 mr-2"></i>Informasi Akun
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="bg-white p-2 rounded-md shadow-sm">
                        <span class="font-medium text-elephant-700">Nama:</span>
                        <span class="text-elephant-800">{{ $user->name }}</span>
                    </div>
                    <div class="bg-white p-2 rounded-md shadow-sm">
                        <span class="font-medium text-elephant-700">Email:</span>
                        <span class="text-elephant-800">{{ $user->email }}</span>
                    </div>
                    <div class="bg-white p-2 rounded-md shadow-sm">
                        <span class="font-medium text-elephant-700">Role:</span>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-success-100 text-success-800">
                            {{ $user->getRoleNames()->first() ?? 'User' }}
                        </span>
                    </div>
                    <div class="bg-white p-2 rounded-md shadow-sm">
                        <span class="font-medium text-elephant-700">Bergabung:</span>
                        <span class="text-elephant-800">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
                <x-button href="{{ route('welcome') }}" variant="ghost" size="lg" class="w-full shadow-md hover:shadow-lg transition-shadow duration-300 transform hover:scale-105">
                    <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                </x-button>
            </div>
        </div>
    </x-card>
</div>
@endsection