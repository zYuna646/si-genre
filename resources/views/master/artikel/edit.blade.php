@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Edit Artikel: {{ $artikel->title }}</h1>
        <p class="text-gray-600">Perbarui informasi artikel PIKR</p>
    </div>

    <x-form-section title="Data Artikel" submit="{{ route('master.artikel.update', $artikel->id) }}" enctype="multipart/form-data">
        @method('PUT')
        <input type="hidden" name="pikr_id" value="{{ $pikr->id }}">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <x-input 
                    name="title" 
                    label="Judul Artikel" 
                    placeholder="Masukkan judul artikel" 
                    required 
                    :value="old('title', $artikel->title)"
                    :error="$errors->first('title')"
                />
                @error('title')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Konten Artikel</label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="10" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                    placeholder="Tulis konten artikel di sini..."
                >{{ old('content', $artikel->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="cover" class="block text-sm font-medium text-gray-700 mb-1">Cover Artikel</label>
                @if ($artikel->cover)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $artikel->cover) }}" alt="{{ $artikel->title }}" class="w-32 h-32 object-cover rounded">
                        <p class="text-sm text-gray-600 mt-1">Cover saat ini</p>
                    </div>
                @endif
                <input 
                    type="file" 
                    name="cover" 
                    id="cover" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                />
                @error('cover')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah cover.</p>
            </div>


        </div>

        <x-slot name="actions">
            <a href="{{ route('master.artikel.index', ['pikr_id' => $pikr->id]) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-elephant-600 border border-transparent rounded-md shadow-sm hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                Perbarui
            </button>
        </x-slot>
    </x-form-section>
</div>
@endsection