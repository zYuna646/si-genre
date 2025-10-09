@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Edit PIKR</h1>
        <p class="text-gray-600">Perbarui informasi PIKR</p>
    </div>

    <x-form-section title="Data PIKR" submit="{{ route('master.pikr.update', $pikr) }}" enctype="multipart/form-data">
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input 
                    name="name" 
                    label="Nama PIKR" 
                    placeholder="Masukkan nama PIKR" 
                    required 
                    :value="old('name', $pikr->name)"
                    :error="$errors->first('name')"
                />
                @error('name')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea 
                    name="desc" 
                    id="desc" 
                    rows="3" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                    placeholder="Deskripsi singkat tentang PIKR"
                >{{ old('desc', $pikr->desc) }}</textarea>
            </div>

            <div>
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo PIKR</label>
                <input 
                    type="file" 
                    name="logo" 
                    id="logo" 
                    accept="image/*"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                />
                @if($pikr->logo)
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Logo saat ini:</p>
                        <img src="{{ asset('storage/' . $pikr->logo) }}" alt="Logo PIKR" class="mt-1 h-16 w-auto">
                    </div>
                @endif
                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF (Maks. 2MB)</p>
                @error('logo')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sk" class="block text-sm font-medium text-gray-700 mb-1">Surat Keputusan (SK)</label>
                <input 
                    type="file" 
                    name="sk" 
                    id="sk" 
                    accept="application/pdf"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                />
                @if($pikr->sk)
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">SK saat ini:</p>
                        <a href="{{ asset('storage/' . $pikr->sk) }}" target="_blank" class="text-elephant-600 hover:underline">Lihat SK</a>
                    </div>
                @endif
                <p class="mt-1 text-sm text-gray-500">Format: PDF (Maks. 5MB)</p>
                @error('sk')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 mb-4">
            <h3 class="text-lg font-medium text-elephant-900">Admin PIKR</h3>
            <p class="text-sm text-gray-600">Informasi admin yang mengelola PIKR ini</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 rounded-full bg-elephant-100 flex items-center justify-center">
                        <span class="text-elephant-700">{{ substr($pikr->user->name, 0, 1) }}</span>
                    </div>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm font-medium text-gray-900">{{ $pikr->user->name }}</h4>
                    <p class="text-sm text-gray-500">{{ $pikr->user->email }}</p>
                </div>
            </div>
        </div>

        <x-slot name="actions">
            <a href="{{ route('master.pikr.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-elephant-600 border border-transparent rounded-md shadow-sm hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                Perbarui
            </button>
        </x-slot>
    </x-form-section>
</div>
@endsection