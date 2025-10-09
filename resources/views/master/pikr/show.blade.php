@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-elephant-900">Detail PIKR</h1>
        <div class="flex space-x-2">
            <a href="{{ route('master.pikr.edit', $pikr) }}" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
                Edit
            </a>
            <a href="{{ route('master.pikr.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-elephant-900 mb-4">Informasi PIKR</h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nama PIKR</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $pikr->name }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Deskripsi</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $pikr->desc ?: 'Tidak ada deskripsi' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tanggal Dibuat</h4>
                            <p class="mt-1 text-base text-gray-900">{{ $pikr->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        
                        @if($pikr->logo)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Logo PIKR</h4>
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $pikr->logo) }}" alt="Logo PIKR" class="h-24 w-auto">
                            </div>
                        </div>
                        @endif
                        
                        @if($pikr->sk)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Surat Keputusan (SK)</h4>
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $pikr->sk) }}" target="_blank" class="px-3 py-1 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    Lihat SK
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-elephant-900 mb-4">Admin PIKR</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-full bg-elephant-100 flex items-center justify-center">
                                    <span class="text-elephant-700 text-lg">{{ substr($pikr->user->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-medium text-gray-900">{{ $pikr->user->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $pikr->user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection