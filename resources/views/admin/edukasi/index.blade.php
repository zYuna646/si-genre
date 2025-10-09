@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Data Edukasi</h1>
        <a href="{{ route('master.edukasi.create') }}" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
            Tambah Edukasi
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($edukasi as $index => $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ asset('storage/' . $item->cover) }}" alt="{{ $item->name }}" class="h-16 w-16 object-cover rounded">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->kategori->name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                        {{ $item->desc }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-elephant-600 hover:text-elephant-900">
                            Lihat File
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('master.edukasi.show', $item) }}" class="text-elephant-600 hover:text-elephant-900">Lihat</a>
                            <a href="{{ route('master.edukasi.edit', $item) }}" class="text-elephant-600 hover:text-elephant-900">Edit</a>
                            <form action="{{ route('master.edukasi.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus edukasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-old-brick-600 hover:text-old-brick-900">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                        Tidak ada data edukasi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($edukasi) && method_exists($edukasi, 'links'))
    <div class="mt-4">
        {{ $edukasi->links() }}
    </div>
    @endif
</div>
@endsection