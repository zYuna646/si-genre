@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Laporan Kegiatan</h1>
        <a href="{{ route('master.laporan.show', $laporan->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('master.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Informasi Kegiatan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 font-medium">Nama Kegiatan:</p>
                        <p class="text-gray-800">{{ $laporan->kegiatan->nama_kegiatan }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-medium">Tanggal:</p>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($laporan->kegiatan->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($laporan->kegiatan->tanggal_selesai)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Peserta Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Peserta</h2>
                
                <div class="mb-4">
                    <label for="jumlah_peserta" class="block text-gray-700 font-medium mb-2">Jumlah Peserta</label>
                    <input type="number" name="jumlah_peserta" id="jumlah_peserta" value="{{ $laporan->jumlah_peserta }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label for="daftar_hadir" class="block text-gray-700 font-medium mb-2">Daftar Hadir (PDF)</label>
                    @if($laporan->daftar_hadir)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $laporan->daftar_hadir) }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                            File saat ini
                        </a>
                    </div>
                    @endif
                    <input type="file" name="daftar_hadir" id="daftar_hadir" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".pdf">
                    <p class="text-sm text-gray-500 mt-1">Upload file baru untuk mengganti yang lama</p>
                </div>
            </div>

            <!-- Dokumentasi Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Dokumentasi</h2>
                
                <div class="mb-4">
                    <label for="dokumentasi_foto" class="block text-gray-700 font-medium mb-2">Foto Kegiatan</label>
                    @if($laporan->dokumentasi_foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $laporan->dokumentasi_foto) }}" alt="Foto Kegiatan" class="h-32 rounded-lg shadow-sm">
                    </div>
                    @endif
                    <input type="file" name="dokumentasi_foto" id="dokumentasi_foto" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
                    <p class="text-sm text-gray-500 mt-1">Upload foto baru untuk mengganti yang lama</p>
                </div>
                
                <div class="mb-4">
                    <label for="dokumentasi_video" class="block text-gray-700 font-medium mb-2">Video Kegiatan (Opsional)</label>
                    @if($laporan->dokumentasi_video)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $laporan->dokumentasi_video) }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                            Video saat ini
                        </a>
                    </div>
                    @endif
                    <input type="file" name="dokumentasi_video" id="dokumentasi_video" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="video/*">
                    <p class="text-sm text-gray-500 mt-1">Upload video baru untuk mengganti yang lama</p>
                </div>
            </div>

            <!-- Hasil & Capaian Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Hasil & Capaian</h2>
                
                <div class="mb-4">
                    <label for="ringkasan_kegiatan" class="block text-gray-700 font-medium mb-2">Ringkasan Kegiatan</label>
                    <textarea name="ringkasan_kegiatan" id="ringkasan_kegiatan" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $laporan->ringkasan_kegiatan }}</textarea>
                </div>
            </div>

            <!-- Lampiran Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Lampiran</h2>
                
                <div class="mb-4">
                    <label for="surat_undangan" class="block text-gray-700 font-medium mb-2">Surat Undangan (Opsional)</label>
                    @if($laporan->surat_undangan)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $laporan->surat_undangan) }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                            File saat ini
                        </a>
                    </div>
                    @endif
                    <input type="file" name="surat_undangan" id="surat_undangan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".pdf,.doc,.docx">
                    <p class="text-sm text-gray-500 mt-1">Upload file baru untuk mengganti yang lama</p>
                </div>
                
                <div class="mb-4">
                    <label for="notulen_rapat" class="block text-gray-700 font-medium mb-2">Notulen Rapat (Opsional)</label>
                    @if($laporan->notulen_rapat)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $laporan->notulen_rapat) }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                            File saat ini
                        </a>
                    </div>
                    @endif
                    <input type="file" name="notulen_rapat" id="notulen_rapat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".pdf,.doc,.docx">
                    <p class="text-sm text-gray-500 mt-1">Upload file baru untuk mengganti yang lama</p>
                </div>
                
                <div class="mb-4">
                    <label for="brosur_poster" class="block text-gray-700 font-medium mb-2">Brosur/Poster Kegiatan (Opsional)</label>
                    @if($laporan->brosur_poster)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $laporan->brosur_poster) }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                            File saat ini
                        </a>
                    </div>
                    @endif
                    <input type="file" name="brosur_poster" id="brosur_poster" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*,.pdf">
                    <p class="text-sm text-gray-500 mt-1">Upload file baru untuk mengganti yang lama</p>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection