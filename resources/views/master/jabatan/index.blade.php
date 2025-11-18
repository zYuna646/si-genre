@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Daftar Jabatan PIKR: {{ $pikr->nama }}</h1>
        <div class="flex space-x-2">
            <button id="showStructureBtn" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                Struktur
            </button>
            <a href="{{ route('master.jabatan.create', ['pikr_id' => $pikr->id]) }}" class="px-4 py-2 bg-elephant-600 text-white rounded-lg hover:bg-elephant-700 transition-colors duration-200">
                Tambah Jabatan
            </a>
        </div>
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Jabatan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan Atasan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($jabatans as $index => $jabatan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $jabatans->firstItem() + $index }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $jabatan->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($jabatan->anggotas->count() > 0)
                            {{ $jabatan->anggotas->pluck('nama')->join(', ') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $jabatan->desc ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $jabatan->parent->name ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('master.jabatan.show', $jabatan->id) }}" class="text-elephant-600 hover:text-elephant-900" title="Detail">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('master.jabatan.edit', $jabatan->id) }}" class="text-elephant-600 hover:text-elephant-900" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('master.jabatan.destroy', $jabatan->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-old-brick-600 hover:text-old-brick-900" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                        Tidak ada data jabatan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $jabatans->appends(['pikr_id' => $pikr->id])->links() }}
    </div>
    
    <div class="mt-6">
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
            Kembali
        </a>
    </div>
</div>
    <!-- Modal Structure -->
    <div id="structureModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-3/4 lg:w-2/3 max-h-screen overflow-y-auto">
            <div class="border-b px-4 py-2 flex items-center justify-between">
                <h3 class="font-semibold text-lg text-elephant-900">Struktur Jabatan PIKR: {{ $pikr->nama }}</h3>
                <button id="closeStructureModal" class="text-black hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <div id="structureTree" class="p-4">
                    <!-- Structure will be loaded here -->
                    <div class="flex justify-center items-center">
                        <svg class="animate-spin h-8 w-8 text-elephant-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showStructureBtn = document.getElementById('showStructureBtn');
            const structureModal = document.getElementById('structureModal');
            const closeStructureModal = document.getElementById('closeStructureModal');
            const structureTree = document.getElementById('structureTree');

            // Show modal
            showStructureBtn.addEventListener('click', function() {
                structureModal.classList.remove('hidden');
                loadStructureData();
            });

            // Close modal
            closeStructureModal.addEventListener('click', function() {
                structureModal.classList.add('hidden');
            });

            // Close modal when clicking outside
            structureModal.addEventListener('click', function(e) {
                if (e.target === structureModal) {
                    structureModal.classList.add('hidden');
                }
            });

            // Load structure data
            function loadStructureData() {
                fetch(`/api/jabatan/structure?pikr_id={{ $pikr->id }}`)
                    .then(response => response.json())
                    .then(data => {
                        renderStructure(data);
                    })
                    .catch(error => {
                        structureTree.innerHTML = `
                            <div class="text-center text-red-600 p-4">
                                Terjadi kesalahan saat memuat struktur. Silakan coba lagi.
                            </div>
                        `;
                        console.error('Error loading structure:', error);
                    });
            }

            // Render structure
            function renderStructure(data) {
                if (!data || data.length === 0) {
                    structureTree.innerHTML = `
                        <div class="text-center text-gray-600 p-4">
                            Tidak ada data struktur jabatan.
                        </div>
                    `;
                    return;
                }

                // Find root nodes (nodes without parent)
                const rootNodes = data.filter(item => !item.parent_id);
                
                let html = '<ul class="structure-tree">';
                rootNodes.forEach(node => {
                    html += renderNode(node, data);
                });
                html += '</ul>';

                structureTree.innerHTML = html;
            }

            // Render a single node and its children
            function renderNode(node, allNodes) {
                const children = allNodes.filter(item => item.parent_id === node.id);
                
                let html = `
                    <li class="mb-2">
                        <div class="bg-elephant-100 p-3 rounded-lg shadow-sm">
                            <div class="font-bold text-elephant-800">${node.name}</div>
                            <div class="text-sm text-gray-600">${node.desc || '-'}</div>
                            <div class="mt-1 text-sm">
                                <span class="font-semibold">Anggota:</span> 
                                ${node.anggotas && node.anggotas.length > 0 
                                    ? node.anggotas.map(a => a.nama).join(', ') 
                                    : '-'}
                            </div>
                        </div>
                `;

                if (children.length > 0) {
                    html += '<ul class="pl-8 mt-2 border-l-2 border-elephant-300">';
                    children.forEach(child => {
                        html += renderNode(child, allNodes);
                    });
                    html += '</ul>';
                }

                html += '</li>';
                return html;
            }
        });
    </script>

    <style>
        .structure-tree {
            list-style-type: none;
            padding-left: 0;
        }
        .structure-tree ul {
            list-style-type: none;
        }
    </style>
@endsection