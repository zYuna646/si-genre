@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Buat Laporan Kegiatan</h1>
        <a href="{{ route('master.kegiatan.show', $kegiatan->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('master.laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}">
            
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Informasi Kegiatan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 font-medium">Nama Kegiatan:</p>
                        <p class="text-gray-800">{{ $kegiatan->nama_kegiatan }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-medium">Tanggal:</p>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-medium">Lokasi:</p>
                        <p class="text-gray-800">{{ $kegiatan->lokasi }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-medium">PIKR:</p>
                        <p class="text-gray-800">{{ $kegiatan->pikr->nama_pikr }}</p>
                    </div>
                </div>
            </div>

            <!-- Peserta Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Peserta</h2>
                
                <div class="mb-4">
                    <label for="jumlah_peserta" class="block text-gray-700 font-medium mb-2">Jumlah Peserta</label>
                    <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label for="daftar_hadir" class="block text-gray-700 font-medium mb-2">Daftar Hadir (PDF)</label>
                    <input type="file" name="daftar_hadir" id="daftar_hadir" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".pdf">
                    <p class="text-sm text-gray-500 mt-1">Upload file daftar hadir dalam format PDF</p>
                </div>
            </div>

            <!-- Dokumentasi Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Dokumentasi</h2>
                
                <div class="mb-4">
                    <label for="dokumentasi_foto" class="block text-gray-700 font-medium mb-2">Foto Kegiatan</label>
                    <input type="file" name="dokumentasi_foto" id="dokumentasi_foto" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
                    <p class="text-sm text-gray-500 mt-1">Upload foto dokumentasi kegiatan (JPG, PNG)</p>
                </div>
                
                <div class="mb-4">
                    <label for="dokumentasi_video" class="block text-gray-700 font-medium mb-2">Video Kegiatan (Opsional)</label>
                    <input type="file" name="dokumentasi_video" id="dokumentasi_video" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="video/*">
                    <p class="text-sm text-gray-500 mt-1">Upload video dokumentasi kegiatan (MP4, MOV)</p>
                </div>
            </div>

            <!-- Hasil & Capaian Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Hasil & Capaian</h2>
                
                <div class="mb-4">
                    <label for="ringkasan_kegiatan" class="block text-gray-700 font-medium mb-2">Ringkasan Kegiatan</label>
                    <textarea name="ringkasan_kegiatan" id="ringkasan_kegiatan" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    <p class="text-sm text-gray-500 mt-1">Tuliskan ringkasan kegiatan yang telah terlaksana</p>
                </div>
            </div>

            <!-- Lampiran Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Lampiran</h2>
                
                <div class="mb-4">
                    <label for="surat_undangan" class="block text-gray-700 font-medium mb-2">Surat Undangan (Opsional)</label>
                    <input type="file" name="surat_undangan" id="surat_undangan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".pdf,.doc,.docx">
                    <p class="text-sm text-gray-500 mt-1">Upload file surat undangan (PDF, DOC, DOCX)</p>
                </div>
                
                <div class="mb-4">
                    <label for="notulen_rapat" class="block text-gray-700 font-medium mb-2">Notulen Rapat (Opsional)</label>
                    <input type="file" name="notulen_rapat" id="notulen_rapat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".pdf,.doc,.docx">
                    <p class="text-sm text-gray-500 mt-1">Upload file notulen rapat (PDF, DOC, DOCX)</p>
                </div>
                
                <div class="mb-4">
                    <label for="brosur_poster" class="block text-gray-700 font-medium mb-2">Brosur/Poster Kegiatan (Opsional)</label>
                    <input type="file" name="brosur_poster" id="brosur_poster" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*,.pdf">
                    <p class="text-sm text-gray-500 mt-1">Upload file brosur atau poster kegiatan (JPG, PNG, PDF)</p>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection