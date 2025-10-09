@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold text-elephant-900">{{ $artikel->title }}</h1>
            <p class="text-gray-600">PIKR: {{ $pikr->name }}</p>
        </div>
        <div>
            <a href="{{ route('master.artikel.index', ['pikr_id' => $pikr->id]) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Detail Artikel</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Informasi lengkap artikel</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('master.artikel.edit', $artikel->id) }}" class="px-3 py-1 text-sm font-medium text-white bg-elephant-600 rounded-md hover:bg-elephant-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
                <form action="{{ route('master.artikel.destroy', $artikel->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 text-sm font-medium text-white bg-old-brick-600 rounded-md hover:bg-old-brick-700" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($artikel->isVerified)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Terverifikasi
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Belum Terverifikasi
                            </span>
                        @endif
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Tanggal Dibuat</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $artikel->created_at->format('d F Y, H:i') }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Terakhir Diperbarui</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $artikel->updated_at->format('d F Y, H:i') }}</dd>
                </div>
                @if($artikel->cover)
                <div class="bg-white px-4 py-5 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 mb-3">Cover Artikel</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <img src="{{ asset('storage/' . $artikel->cover) }}" alt="{{ $artikel->title }}" class="max-w-lg rounded-lg shadow-md">
                    </dd>
                </div>
                @endif
                <div class="bg-gray-50 px-4 py-5 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500 mb-3">Konten Artikel</dt>
                    <dd class="mt-1 text-sm text-gray-900 prose max-w-none">
                        {!! nl2br(e($artikel->content)) !!}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection