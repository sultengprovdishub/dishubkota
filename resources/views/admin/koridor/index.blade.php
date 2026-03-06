@extends('layouts.admin')
@section('title', 'Manajemen Koridor')
@section('page-title', 'Koridor Trayek')
@section('page-subtitle', 'Kelola jalur dan koridor Bus Trans Palu')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div></div>
        <a href="{{ route('admin.koridor.create') }}" class="btn-primary">
            <i class="bx bx-plus"></i> Tambah Koridor
        </a>
    </div>

    @if(session('success'))
        <div
            class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-2">
            <i class="bx bx-check-circle text-lg"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Koridor
                    </th>
                    <th
                        class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                        Warna</th>
                    <th
                        class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                        Halte</th>
                    <th
                        class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                        Status</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($koridor as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-white text-xs shrink-0"
                                    style="background-color:{{ $item->warna }};">
                                    {{ $item->kode }}
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $item->nama }}</div>
                                    @if($item->deskripsi)
                                        <div class="text-xs text-gray-400 line-clamp-1">{{ $item->deskripsi }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full border-2 border-white shadow-sm"
                                    style="background:{{ $item->warna }};"></span>
                                <span class="text-xs text-gray-500 font-mono">{{ $item->warna }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="badge-blue">{{ $item->halte_count }} halte</span>
                        </td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            <span
                                class="badge {{ $item->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.halte.index', ['koridor_id' => $item->id]) }}"
                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                    title="Kelola Halte">
                                    <i class="bx bx-map-pin text-lg"></i>
                                </a>
                                <a href="{{ route('admin.koridor.edit', $item) }}"
                                    class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Edit">
                                    <i class="bx bx-edit text-lg"></i>
                                </a>
                                <form action="{{ route('admin.koridor.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Hapus koridor ini beserta semua haltnya?')">
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
                            <i class="bx bx-route text-5xl mb-2"></i>
                            <p>Belum ada koridor.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection