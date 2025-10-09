@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Edit Kategori Edukasi</h1>
        <p class="text-gray-600">Perbarui informasi kategori edukasi</p>
    </div>

    <x-form-section title="Data Kategori" submit="{{ route('master.kategori_edukasi.update', $kategori_edukasi) }}" method="PUT">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input 
                    name="name" 
                    label="Nama Kategori" 
                    placeholder="Masukkan nama kategori" 
                    required 
                    :error="$errors->first('name')"
                    value="{{ old('name', $kategori_edukasi->name) }}"
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
                    placeholder="Deskripsi singkat tentang kategori"
                >{{ old('desc', $kategori_edukasi->desc) }}</textarea>
                @error('desc')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <x-slot name="actions">
            <a href="{{ route('master.kategori_edukasi.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200 mr-2">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
                Simpan Perubahan
            </button>
        </x-slot>
    </x-form-section>
</div>
@endsection