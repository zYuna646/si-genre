@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Tambah PIKR Baru</h1>
        <p class="text-gray-600">Buat PIKR baru beserta admin pengelolanya</p>
    </div>

    <x-form-section title="Data PIKR" submit="{{ route('master.pikr.store') }}" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input 
                    name="name" 
                    label="Nama PIKR" 
                    placeholder="Masukkan nama PIKR" 
                    required 
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
                >{{ old('desc') }}</textarea>
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
                <p class="mt-1 text-sm text-gray-500">Format: PDF (Maks. 5MB)</p>
                @error('sk')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 mb-4">
            <h3 class="text-lg font-medium text-elephant-900">Data Admin PIKR</h3>
            <p class="text-sm text-gray-600">Admin akan dibuat secara otomatis untuk mengelola PIKR ini</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input 
                    name="admin_name" 
                    label="Nama Admin" 
                    placeholder="Masukkan nama admin" 
                    required 
                    :error="$errors->first('admin_name')"
                />
                @error('admin_name')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input 
                    name="admin_email" 
                    type="email"
                    label="Email Admin" 
                    placeholder="Masukkan email admin" 
                    required 
                    :error="$errors->first('admin_email')"
                />
                @error('admin_email')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input 
                    name="admin_password" 
                    type="password"
                    label="Password Admin" 
                    placeholder="Masukkan password" 
                    required 
                    :error="$errors->first('admin_password')"
                />
                @error('admin_password')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <x-slot name="actions">
            <a href="{{ route('master.pikr.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-elephant-600 border border-transparent rounded-md shadow-sm hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                Simpan
            </button>
        </x-slot>
    </x-form-section>
</div>
@endsection