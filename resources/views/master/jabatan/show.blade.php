@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-elephant-900">Detail Jabatan</h1>
        <div class="flex space-x-2">
            <a href="{{ route('master.jabatan.edit', $jabatan->id) }}" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
                Edit
            </a>
            <a href="{{ route('master.jabatan.index', ['pikr_id' => $jabatan->pikr_id]) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-elephant-900 mb-4">Informasi Jabatan</h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nama Jabatan</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $jabatan->name }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Deskripsi</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $jabatan->desc ?? '-' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Jabatan Atasan</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $parent->name ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-elephant-900 mb-4">Anggota</h3>
                    @if($anggotas->count() > 0)
                        <div class="space-y-3">
                            @foreach($anggotas as $anggota)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="h-12 w-12 rounded-full bg-elephant-100 flex items-center justify-center">
                                                <span class="text-elephant-700 text-lg">{{ substr($anggota->nama, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-base font-medium text-gray-900">{{ $anggota->nama }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-500">Tidak ada anggota yang ditugaskan</p>
                        </div>
                    @endif
                    
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-elephant-900 mb-4">PIKR</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-elephant-100 flex items-center justify-center">
                                        <span class="text-elephant-700 text-lg">{{ substr($pikr->nama, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-base font-medium text-gray-900">{{ $pikr->nama }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection