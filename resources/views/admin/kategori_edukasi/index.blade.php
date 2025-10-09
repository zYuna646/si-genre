@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Data Kategori Edukasi</h1>
        <a href="{{ route('master.kategori_edukasi.create') }}" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
            Tambah Kategori
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($kategori as $index => $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                        {{ $item->desc }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('master.kategori_edukasi.edit', $item) }}" class="text-elephant-600 hover:text-elephant-900">Edit</a>
                            <form action="{{ route('master.kategori_edukasi.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-old-brick-600 hover:text-old-brick-900">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                        Tidak ada data kategori edukasi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($kategori) && method_exists($kategori, 'links'))
    <div class="mt-4">
        {{ $kategori->links() }}
    </div>
    @endif
</div>
@endsection