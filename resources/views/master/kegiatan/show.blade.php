@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-elephant-900">Detail Kegiatan</h1>
        <div class="flex space-x-2">
            <a href="{{ route('master.kegiatan.edit', $kegiatan) }}" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
                Edit
            </a>
            <a href="{{ route('master.laporan.create', ['kegiatan_id' => $kegiatan->id]) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                Buat Laporan
            </a>
            <form action="{{ route('master.kegiatan.destroy', $kegiatan->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                    Hapus
                </button>
            </form>
            <a href="{{ route('master.kegiatan.index', ['pikr_id' => $kegiatan->pikr_id]) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-elephant-900 mb-4">Informasi Kegiatan</h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nama Kegiatan</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $kegiatan->name }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tema</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $kegiatan->tema }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tanggal Pelaksanaan</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $kegiatan->tanggal_pelaksanaan->format('d F Y') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Lokasi</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $kegiatan->lokasi }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-elephant-900 mb-4">PIKR</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-full bg-elephant-100 flex items-center justify-center">
                                    <span class="text-elephant-700 text-lg">{{ substr($kegiatan->pikr->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-medium text-gray-900">{{ $kegiatan->pikr->name }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-elephant-900 mb-4">Tujuan Kegiatan</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700">{{ $kegiatan->tujuan ?? 'Tidak ada tujuan yang ditentukan' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
  
            <!-- Laporan Kegiatan Section -->
            @if($kegiatan->laporanKegiatan)
            <div class="mt-8 border-t pt-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-elephant-900">Laporan Kegiatan</h3>
                    <div class="flex items-center">
                        @if($kegiatan->laporanKegiatan->isVerified)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                                Terverifikasi
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                                Belum Terverifikasi
                            </span>
                            
                            @if(auth()->user()->getRoleNames()[0] === 'admin')
                            <form action="{{ route('master.laporan.verify', $kegiatan->laporanKegiatan->id) }}" method="POST" class="ml-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Verifikasi
                                </button>
                            </form>
                            @endif
                        @endif
                    </div>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Jumlah Peserta</h4>
                            <p class="text-gray-900">{{ $kegiatan->laporanKegiatan->jumlah_peserta }} orang</p>
                            
                            <h4 class="text-sm font-medium text-gray-500 mt-4 mb-2">Ringkasan Kegiatan</h4>
                            <p class="text-gray-900">{{ $kegiatan->laporanKegiatan->ringkasan_kegiatan }}</p>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Dokumentasi</h4>
                            <div class="space-y-2">
                                @if($kegiatan->laporanKegiatan->daftar_hadir)
                                <div>
                                    <a href="{{ asset('storage/' . $kegiatan->laporanKegiatan->daftar_hadir) }}" target="_blank" class="text-elephant-600 hover:text-elephant-800 hover:underline flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Daftar Hadir
                                    </a>
                                </div>
                                @endif
                                
                                @if($kegiatan->laporanKegiatan->dokumentasi_foto)
                                <div>
                                    <a href="{{ asset('storage/' . $kegiatan->laporanKegiatan->dokumentasi_foto) }}" target="_blank" class="text-elephant-600 hover:text-elephant-800 hover:underline flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Dokumentasi Foto
                                    </a>
                                </div>
                                @endif
                                
                                @if($kegiatan->laporanKegiatan->dokumentasi_video)
                                <div>
                                    <a href="{{ asset('storage/' . $kegiatan->laporanKegiatan->dokumentasi_video) }}" target="_blank" class="text-elephant-600 hover:text-elephant-800 hover:underline flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        Dokumentasi Video
                                    </a>
                                </div>
                                @endif
                                
                                @if($kegiatan->laporanKegiatan->surat_undangan)
                                <div>
                                    <a href="{{ asset('storage/' . $kegiatan->laporanKegiatan->surat_undangan) }}" target="_blank" class="text-elephant-600 hover:text-elephant-800 hover:underline flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Surat Undangan
                                    </a>
                                </div>
                                @endif
                                
                                @if($kegiatan->laporanKegiatan->notulen_rapat)
                                <div>
                                    <a href="{{ asset('storage/' . $kegiatan->laporanKegiatan->notulen_rapat) }}" target="_blank" class="text-elephant-600 hover:text-elephant-800 hover:underline flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Notulen Rapat
                                    </a>
                                </div>
                                @endif
                                
                                @if($kegiatan->laporanKegiatan->brosur_poster)
                                <div>
                                    <a href="{{ asset('storage/' . $kegiatan->laporanKegiatan->brosur_poster) }}" target="_blank" class="text-elephant-600 hover:text-elephant-800 hover:underline flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Brosur/Poster
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection