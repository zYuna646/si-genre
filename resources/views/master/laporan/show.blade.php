@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Laporan Kegiatan</h1>
        <div class="flex space-x-2">
            <a href="{{ route('master.kegiatan.show', $laporan->kegiatan->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
            <a href="{{ route('master.laporan.edit', $laporan->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                Edit
            </a>
            <form action="{{ route('master.laporan.destroy', $laporan->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
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
                <div>
                    <p class="text-gray-600 font-medium">Lokasi:</p>
                    <p class="text-gray-800">{{ $laporan->kegiatan->lokasi }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-medium">PIKR:</p>
                    <p class="text-gray-800">{{ $laporan->kegiatan->pikr->nama_pikr }}</p>
                </div>
            </div>
        </div>

        <!-- Peserta Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Peserta</h2>
            
            <div class="mb-4">
                <p class="text-gray-600 font-medium">Jumlah Peserta:</p>
                <p class="text-gray-800">{{ $laporan->jumlah_peserta }} orang</p>
            </div>
            
            @if($laporan->daftar_hadir)
            <div class="mb-4">
                <p class="text-gray-600 font-medium">Daftar Hadir:</p>
                <a href="{{ asset('storage/' . $laporan->daftar_hadir) }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                    Lihat Daftar Hadir
                </a>
            </div>
            @endif
        </div>

        <!-- Dokumentasi Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Dokumentasi</h2>
            
            @if($laporan->dokumentasi_foto)
            <div class="mb-4">
                <p class="text-gray-600 font-medium mb-2">Foto Kegiatan:</p>
                <img src="{{ asset('storage/' . $laporan->dokumentasi_foto) }}" alt="Foto Kegiatan" class="max-w-full h-auto rounded-lg shadow-md">
            </div>
            @endif
        </div>

        <!-- Hasil & Capaian Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Hasil & Capaian</h2>
            
            <div class="mb-4">
                <p class="text-gray-600 font-medium">Ringkasan Kegiatan:</p>
                <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-800 whitespace-pre-line">{{ $laporan->ringkasan_kegiatan }}</p>
                </div>
            </div>
        </div>

        <!-- Lampiran Section -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 pb-2 border-b">Lampiran</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @if($laporan->surat_undangan)
                <div class="p-4 border rounded-lg">
                    <p class="text-gray-600 font-medium">Surat Undangan:</p>
                    <a href="{{ asset('storage/' . $laporan->surat_undangan) }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                        Lihat Surat Undangan
                    </a>
                </div>
                @endif
                
                @if($laporan->notulen_rapat)
                <div class="p-4 border rounded-lg">
                    <p class="text-gray-600 font-medium">Notulen Rapat:</p>
                    <a href="{{ asset('storage/' . $laporan->notulen_rapat) }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                        Lihat Notulen Rapat
                    </a>
                </div>
                @endif
                
                @if($laporan->brosur_poster)
                <div class="p-4 border rounded-lg">
                    <p class="text-gray-600 font-medium">Brosur/Poster:</p>
                    <a href="{{ asset('storage/' . $laporan->brosur_poster) }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                        Lihat Brosur/Poster
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection