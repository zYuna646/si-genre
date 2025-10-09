@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Edit Jabatan: {{ $jabatan->name }}</h1>
        <p class="text-gray-600">Perbarui informasi jabatan PIKR</p>
    </div>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <x-form-section title="Data Jabatan" submit="{{ route('master.jabatan.update', $jabatan->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="pikr_id" value="{{ $jabatan->pikr_id }}">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="anggota_ids" class="block text-sm font-medium text-gray-700 mb-1">Anggota</label>
                <select 
                    name="anggota_ids[]" 
                    id="anggota_ids" 
                    class="select2-dropdown w-full"
                    required
                    multiple
                >
                    @foreach($anggotas as $ang)
                        <option 
                            value="{{ $ang->id }}" 
                            {{ (old('anggota_ids', $selectedAnggotas->pluck('id')->toArray()) && in_array($ang->id, old('anggota_ids', $selectedAnggotas->pluck('id')->toArray()))) ? 'selected' : '' }}
                        >
                            {{ $ang->nama }}
                        </option>
                    @endforeach
                </select>
                <div class="mt-2 flex items-center text-xs text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-elephant-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Klik untuk memilih beberapa anggota
                </div>
                @error('anggota_ids')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input 
                    name="name" 
                    label="Nama Jabatan" 
                    placeholder="Masukkan nama jabatan" 
                    required 
                    :value="old('name', $jabatan->name)"
                    :error="$errors->first('name')"
                />
            </div>

            <div class="md:col-span-2">
                <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea 
                    name="desc" 
                    id="desc" 
                    rows="3" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                    placeholder="Masukkan deskripsi jabatan"
                >{{ old('desc', $jabatan->desc) }}</textarea>
                @error('desc')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jabatan_id" class="block text-sm font-medium text-gray-700 mb-1">Jabatan Atasan</label>
                <select 
                    name="jabatan_id" 
                    id="jabatan_id" 
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 border-gray-300 focus:ring-elephant-200 focus:border-elephant-500"
                >
                    <option value="">-- Pilih Jabatan Atasan (Opsional) --</option>
                    @foreach($jabatans as $jbt)
                        <option value="{{ $jbt->id }}" {{ old('jabatan_id', $jabatan->jabatan_id) == $jbt->id ? 'selected' : '' }}>{{ $jbt->name }}</option>
                    @endforeach
                </select>
                @error('jabatan_id')
                    <p class="mt-1 text-sm text-old-brick-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <x-slot name="actions">
            <a href="{{ route('master.jabatan.index', ['pikr_id' => $jabatan->pikr_id]) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-elephant-600 border border-transparent rounded-md shadow-sm hover:bg-elephant-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elephant-500">
                Perbarui
            </button>
        </x-slot>
    </x-form-section>
</div>

<!-- Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-dropdown').select2({
            placeholder: 'Pilih anggota',
            allowClear: true,
            width: '100%',
            theme: 'classic',
            language: {
                noResults: function() {
                    return "Tidak ada hasil yang ditemukan";
                }
            }
        });
    });
</script>
@endsection