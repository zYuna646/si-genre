@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Detail Prestasi</h1>
        <div class="flex space-x-2">
            <a href="{{ route('master.prestasi.edit', $prestasi->id) }}" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
                Edit
            </a>
            <a href="{{ route('master.prestasi.index', ['anggota_id' => $prestasi->anggota_id]) }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <div>
                <h2 class="text-xl font-semibold mb-4">Informasi Prestasi</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Anggota</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $prestasi->anggota->nama }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Jenis Kompetisi</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $prestasi->jenis_kompetisi }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Prestasi</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $prestasi->prestasi }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Sertifikat</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $prestasi->sertifikat ?? '-' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Deskripsi</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $prestasi->deskripsi ?? '-' }}</p>
                    </div>
                </div>
            </div>
            
            <div>
                <h2 class="text-xl font-semibold mb-4">Bukti Foto</h2>
                @if($prestasi->bukti_foto && count($prestasi->bukti_foto) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($prestasi->bukti_foto as $foto)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $foto) }}" alt="Bukti Prestasi" class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Tidak ada bukti foto</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="mt-6">
        <form action="{{ route('master.prestasi.destroy', $prestasi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-old-brick-600 text-white rounded-lg hover:bg-old-brick-700 transition-colors duration-200">
                Hapus Prestasi
            </button>
        </form>
    </div>
</div>
@endsection