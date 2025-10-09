@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Detail Admin BKBN</h1>
        <a href="{{ route('master.bkbn.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
            Kembali
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 gap-4">
                <div class="border-b pb-3">
                    <h3 class="text-sm font-medium text-gray-500">Nama</h3>
                    <p class="mt-1 text-base text-gray-900">{{ $bkbn->name }}</p>
                </div>
                
                <div class="border-b pb-3">
                    <h3 class="text-sm font-medium text-gray-500">Email</h3>
                    <p class="mt-1 text-base text-gray-900">{{ $bkbn->email }}</p>
                </div>
                
                <div class="border-b pb-3">
                    <h3 class="text-sm font-medium text-gray-500">Tanggal Dibuat</h3>
                    <p class="mt-1 text-base text-gray-900">{{ $bkbn->created_at->format('d F Y H:i') }}</p>
                </div>
            </div>
            
            <div class="mt-6 flex space-x-3">
                <a href="{{ route('master.bkbn.edit', $bkbn->id) }}" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
                    Edit
                </a>
                <form action="{{ route('master.bkbn.destroy', $bkbn->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-old-brick-600 text-white rounded-lg hover:bg-old-brick-700 transition-colors duration-200" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection