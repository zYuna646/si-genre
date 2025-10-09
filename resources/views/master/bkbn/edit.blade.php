@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Edit Admin BKBN</h1>
        <a href="{{ route('master.bkbn.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
            Kembali
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('master.bkbn.update', $bkbn->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-elephant-500 focus:border-elephant-500 @error('name') border-red-500 @enderror" value="{{ old('name', $bkbn->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-elephant-500 focus:border-elephant-500 @error('email') border-red-500 @enderror" value="{{ old('email', $bkbn->email) }}" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-elephant-500 focus:border-elephant-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection