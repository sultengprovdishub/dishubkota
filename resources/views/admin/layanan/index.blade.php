@extends('layouts.admin')
@section('title', 'Manajemen Layanan')
@section('page-title', 'Layanan')
@section('page-subtitle', 'Kelola layanan yang ditampilkan di website')
@section('content')
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.layanan.create') }}" class="btn-primary"><i class="bx bx-plus"></i> Tambah Layanan</a>
    </div>
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Nama Layanan</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase hidden md:table-cell">Ikon
                    </th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase hidden md:table-cell">
                        Urutan</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase hidden md:table-cell">
                        Status</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($layanan as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center">
                                    <i class="{{ $item->ikon }} text-primary-700 text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $item->nama }}</div>
                                    <div class="text-xs text-gray-400 line-clamp-1 max-w-xs">{{ $item->deskripsi }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500 hidden md:table-cell"><code
                                class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $item->ikon }}</code></td>
                        <td class="px-6 py-4 text-gray-500 hidden md:table-cell">{{ $item->urutan }}</td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span
                                class="badge {{ $item->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $item->aktif ? 'Aktif' : 'Non-aktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.layanan.edit', $item) }}"
                                    class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg"><i
                                        class="bx bx-edit text-lg"></i></a>
                                <form action="{{ route('admin.layanan.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Hapus layanan?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><i
                                            class="bx bx-trash text-lg"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-gray-400"><i class="bx bx-cog text-5xl mb-2"></i>
                            <p>Belum ada layanan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-100">{{ $layanan->links() }}</div>
    </div>
@endsection