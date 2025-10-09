@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Edit Anggota: {{ $anggota->nama }}</h1>
        <p class="text-gray-600">Perbarui informasi anggota PIKR</p>
    </div>

    <x-form-section title="Data Anggota" submit="{{ route('master.anggota.update', $anggota->id) }}" enctype="multipart/form-data">
        @method('PUT')
        <input type="hidden" name="pikr_id" value="{{ $pikr->id }}">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input 
                    name="nama" 
                    label="Nama Anggota" 
                    placeholder="Masukkan nama anggota" 
                    required 
                    :value="old('nama', $anggota->nama)"
                    :error="$errors->first('nama')"
                />
                @error('nama')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                @if ($anggota->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama }}" class="w-32 h-32 object-cover rounded">
                        <p class="text-sm text-gray-600 mt-1">Foto saat ini</p>
                    </div>
                @endif
                <input 
                    type="file" 
                    name="foto" 
                    id="foto" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                />
                @error('foto')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah foto.</p>
            </div>

            <div>
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                <input 
                    type="date" 
                    name="tanggal_lahir" 
                    id="tanggal_lahir" 
                    value="{{ old('tanggal_lahir', $anggota->tanggal_lahir->format('Y-m-d')) }}" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                />
                @error('tanggal_lahir')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                <select 
                    name="jenis_kelamin" 
                    id="jenis_kelamin" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                >
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <x-slot name="actions">
            <a href="{{ route('master.anggota.index', ['pikr_id' => $pikr->id]) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-elephant-600 border border-transparent rounded-md shadow-sm hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                Perbarui
            </button>
        </x-slot>
    </x-form-section>
</div>
@endsection