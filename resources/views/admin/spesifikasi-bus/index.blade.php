@extends('layouts.admin')
@section('title', 'Spesifikasi Bus')
@section('page-title', 'Spesifikasi Bus Trans Palu')
@section('page-subtitle', 'Kelola data dan informasi spesifikasi armada bus')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div></div>
        <a href="{{ route('admin.spesifikasi-bus.create') }}" class="btn-primary">
            <i class="bx bx-plus"></i> Tambah Spesifikasi
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
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Spesifikasi
                    </th>
                    <th
                        class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                        Nilai</th>
                    <th
                        class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                        Kunci</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($spesifikasi as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0"
                                    style="background:{{ $item->warna_bg }};border:1px solid {{ $item->warna }}33;">
                                    <i class="{{ $item->ikon }}" style="color:{{ $item->warna }};font-size:18px;"></i>
                                </div>
                                <div class="font-semibold text-gray-900">{{ $item->label }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell font-medium text-gray-700">{{ $item->nilai }}</td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            <span
                                class="text-xs text-gray-400 font-mono bg-gray-100 px-2 py-1 rounded-lg">{{ $item->kunci }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.spesifikasi-bus.edit', $item) }}"
                                    class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Edit">
                                    <i class="bx bx-edit text-lg"></i>
                                </a>
                                <form action="{{ route('admin.spesifikasi-bus.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Hapus spesifikasi ini?')">
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
                        <td colspan="4" class="px-6 py-16 text-center text-gray-400">
                            <i class="bx bx-bus text-5xl mb-2"></i>
                            <p>Belum ada data spesifikasi.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection