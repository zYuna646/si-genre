@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Tambah Kegiatan PIKR: {{ $pikr->name }}</h1>
        <p class="text-gray-600">Tambahkan kegiatan baru ke PIKR ini</p>
    </div>

    <x-form-section title="Data Kegiatan" submit="{{ route('master.kegiatan.store', ['pikr_id' => $pikr->id]) }}">
        <input type="hidden" name="pikr_id" value="{{ $pikr->id }}">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input 
                    name="name" 
                    label="Nama Kegiatan" 
                    placeholder="Masukkan nama kegiatan" 
                    required 
                    :error="$errors->first('name')"
                />
                @error('name')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input 
                    name="tema" 
                    label="Tema" 
                    placeholder="Masukkan tema kegiatan" 
                    required 
                    :error="$errors->first('tema')"
                />
                @error('tema')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="tujuan" class="block text-sm font-medium text-gray-700 mb-1">Tujuan</label>
                <textarea 
                    name="tujuan" 
                    id="tujuan" 
                    rows="3" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                    placeholder="Masukkan tujuan kegiatan"
                >{{ old('tujuan') }}</textarea>
                @error('tujuan')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_pelaksanaan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pelaksanaan</label>
                <input 
                    type="date" 
                    name="tanggal_pelaksanaan" 
                    id="tanggal_pelaksanaan" 
                    value="{{ old('tanggal_pelaksanaan') }}" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                />
                @error('tanggal_pelaksanaan')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input 
                    name="lokasi" 
                    label="Lokasi Kegiatan" 
                    placeholder="Masukkan lokasi kegiatan" 
                    required 
                    :error="$errors->first('lokasi')"
                />
                @error('lokasi')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <x-slot name="actions">
            <a href="{{ route('master.kegiatan.index', ['pikr_id' => $pikr->id]) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-elephant-600 border border-transparent rounded-md shadow-sm hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                Simpan
            </button>
        </x-slot>
    </x-form-section>
</div>
@endsection