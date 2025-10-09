@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Laporan Kegiatan</h1>
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama Kegiatan
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        PIKR
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jumlah Peserta
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($laporans as $laporan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $laporan->kegiatan->nama_kegiatan }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            {{ $laporan->kegiatan->pikr->nama_pikr }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($laporan->kegiatan->tanggal_mulai)->format('d M Y') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            {{ $laporan->jumlah_peserta }} orang
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('master.laporan.show', $laporan->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            Detail
                        </a>
                        <a href="{{ route('master.laporan.edit', $laporan->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">
                            Edit
                        </a>
                        <form action="{{ route('master.laporan.destroy', $laporan->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                        Belum ada laporan kegiatan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $laporans->links() }}
        </div>
    </div>
</div>
@endsection