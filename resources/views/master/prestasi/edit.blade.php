@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Edit Prestasi Anggota: {{ $anggota->nama }}</h1>
        <p class="text-gray-600">Perbarui data prestasi anggota</p>
    </div>

    <x-form-section title="Data Prestasi" submit="{{ route('master.prestasi.update', $prestasi->id) }}" enctype="multipart/form-data" method="PUT">
        <input type="hidden" name="anggota_id" value="{{ $anggota->id }}">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input 
                    name="jenis_kompetisi" 
                    label="Jenis Kompetisi" 
                    placeholder="Masukkan jenis kompetisi" 
                    required 
                    :value="$prestasi->jenis_kompetisi"
                    :error="$errors->first('jenis_kompetisi')"
                />
                @error('jenis_kompetisi')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input 
                    name="prestasi" 
                    label="Prestasi" 
                    placeholder="Masukkan prestasi yang diraih" 
                    required 
                    :value="$prestasi->prestasi"
                    :error="$errors->first('prestasi')"
                />
                @error('prestasi')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input 
                    name="sertifikat" 
                    label="Sertifikat" 
                    placeholder="Masukkan nomor sertifikat (opsional)" 
                    :value="$prestasi->sertifikat"
                    :error="$errors->first('sertifikat')"
                />
                @error('sertifikat')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea 
                    name="deskripsi" 
                    id="deskripsi" 
                    rows="3" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                    placeholder="Masukkan deskripsi prestasi (opsional)"
                >{{ $prestasi->deskripsi }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="bukti_foto" class="block text-sm font-medium text-gray-700 mb-1">Bukti Foto</label>
                <input 
                    type="file" 
                    name="bukti_foto[]" 
                    id="bukti_foto" 
                    multiple
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                />
                @error('bukti_foto')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB per file. Anda dapat memilih beberapa file.</p>
                
                @if($prestasi->bukti_foto && count($prestasi->bukti_foto) > 0)
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-700 mb-2">Foto Saat Ini:</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($prestasi->bukti_foto as $foto)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $foto) }}" alt="Bukti Prestasi" class="w-full h-32 object-cover rounded-lg">
                        </div>
                        @endforeach
                    </div>
                    <p class="text-gray-500 text-xs mt-1">Mengunggah foto baru akan menggantikan semua foto yang ada.</p>
                </div>
                @endif
            </div>
        </div>

        <x-slot name="actions">
            <a href="{{ route('master.prestasi.index', ['anggota_id' => $anggota->id]) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-elephant-600 border border-transparent rounded-md shadow-sm hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                Simpan
            </button>
        </x-slot>
    </x-form-section>
</div>
@endsection