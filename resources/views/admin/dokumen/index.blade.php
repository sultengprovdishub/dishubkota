@extends('layouts.admin')
@section('title', 'Manajemen Dokumen')
@section('page-title', 'Dokumen & Unduhan')
@section('page-subtitle', 'Kelola dokumen yang dapat diunduh publik')
@section('content')
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.dokumen.create') }}" class="btn-primary"><i class="bx bx-plus"></i> Upload Dokumen</a>
    </div>
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Judul</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase hidden md:table-cell">
                        Kategori</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase hidden md:table-cell">
                        Unduhan</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($dokumen as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center shrink-0">
                                    <i class="bx bx-file-pdf text-orange-500 text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ Str::limit($item->judul, 50) }}</div>
                                    <div class="text-xs text-gray-400">{{ optional($item->created_at)->format('d M Y') }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell"><span class="badge-blue">{{ $item->kategori }}</span></td>
                        <td class="px-6 py-4 text-gray-500 hidden md:table-cell">{{ number_format($item->unduhan) }}x</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                    class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Lihat"><i
                                        class="bx bx-show text-lg"></i></a>
                                <a href="{{ route('admin.dokumen.edit', $item) }}"
                                    class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg"><i
                                        class="bx bx-edit text-lg"></i></a>
                                <form action="{{ route('admin.dokumen.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Hapus dokumen?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><i
                                            class="bx bx-trash text-lg"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-gray-400"><i class="bx bx-file text-5xl mb-2"></i>
                            <p>Belum ada dokumen.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-100">{{ $dokumen->links() }}</div>
    </div>
@endsection