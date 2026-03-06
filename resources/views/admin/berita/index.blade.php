@extends('layouts.admin')
@section('title', 'Manajemen Berita')
@section('page-title', 'Berita & Artikel')
@section('page-subtitle', 'Kelola konten berita dan artikel')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div></div>
        <a href="{{ route('admin.berita.create') }}" class="btn-primary">
            <i class="bx bx-plus"></i> Tambah Berita
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul</th>
                    <th
                        class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                        Kategori</th>
                    <th
                        class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                        Status</th>
                    <th
                        class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                        Tanggal</th>
                    <th
                        class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                        <i class="bx bx-show"></i> Pengunjung
                    </th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($berita as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                        class="w-10 h-10 rounded-lg object-cover shrink-0">
                                @else
                                    <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center shrink-0">
                                        <i class="bx bx-news text-primary-400"></i>
                                    </div>
                                @endif
                                <div class="font-semibold text-gray-900 line-clamp-1">{{ $item->judul }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="badge-blue">{{ $item->kategori }}</span>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span
                                class="badge {{ $item->status === 'publish' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $item->status === 'publish' ? 'Publish' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500 hidden lg:table-cell">
                            {{ optional($item->created_at)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            <span
                                class="inline-flex items-center gap-1 text-sm font-semibold
                                        {{ $item->views > 100 ? 'text-green-600' : ($item->views > 10 ? 'text-blue-600' : 'text-gray-400') }}">
                                <i class="bx bx-show"></i> {{ number_format($item->views) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.berita.edit', $item) }}"
                                    class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Edit">
                                    <i class="bx bx-edit text-lg"></i>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Hapus">
                                        <i class="bx bx-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                            <i class="bx bx-news text-5xl mb-2"></i>
                            <p>Belum ada berita.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-100">{{ $berita->links() }}</div>
    </div>
@endsection