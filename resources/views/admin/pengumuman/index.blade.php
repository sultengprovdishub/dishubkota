@extends('layouts.admin')
@section('title', 'Manajemen Pengumuman')
@section('page-title', 'Pengumuman')
@section('page-subtitle', 'Kelola pengumuman resmi')
@section('content')
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.pengumuman.create') }}" class="btn-primary"><i class="bx bx-plus"></i> Tambah
            Pengumuman</a>
    </div>
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Judul</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase hidden md:table-cell">
                        Tanggal</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase hidden md:table-cell">
                        Status</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($pengumuman as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-gray-900">{{ Str::limit($item->judul, 60) }}</td>
                        <td class="px-6 py-4 text-gray-500 hidden md:table-cell">
                            {{ optional($item->tanggal_terbit)->format('d M Y') }}</td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span
                                class="badge {{ $item->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $item->status === 'aktif' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.pengumuman.edit', $item) }}"
                                    class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg"><i
                                        class="bx bx-edit text-lg"></i></a>
                                <form action="{{ route('admin.pengumuman.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Hapus pengumuman?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><i
                                            class="bx bx-trash text-lg"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-gray-400"><i class="bx bx-bell text-5xl mb-2"></i>
                            <p>Belum ada pengumuman.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-100">{{ $pengumuman->links() }}</div>
    </div>
@endsection