@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-elephant-900">Detail Anggota</h1>
        <div class="flex space-x-2">
            <a href="{{ route('master.anggota.edit', $anggota) }}" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
                Edit
            </a>
            <a href="{{ route('master.anggota.index', ['pikr_id' => $anggota->pikr_id]) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-elephant-900 mb-4">Informasi Anggota</h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nama</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $anggota->nama }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tanggal Lahir</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $anggota->tanggal_lahir->format('d F Y') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Jenis Kelamin</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $anggota->jenis_kelamin }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-elephant-900 mb-4">PIKR</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-full bg-elephant-100 flex items-center justify-center">
                                    <span class="text-elephant-700 text-lg">{{ substr($anggota->pikr->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-medium text-gray-900">{{ $anggota->pikr->name }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    @if($anggota->jabatans->count() > 0)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-elephant-900 mb-4">Jabatan</h3>
                        <div class="space-y-3">
                            @foreach($anggota->jabatans as $jabatan)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-elephant-100 flex items-center justify-center">
                                                <span class="text-elephant-700 text-lg">{{ substr($jabatan->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-base font-medium text-gray-900">{{ $jabatan->name }}</h4>
                                            @if($jabatan->desc)
                                                <p class="text-sm text-gray-600">{{ $jabatan->desc }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if ($anggota->foto)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-elephant-900 mb-4">Foto Anggota</h3>
                        <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama }}" class="w-full max-w-xs rounded-lg shadow-md">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection