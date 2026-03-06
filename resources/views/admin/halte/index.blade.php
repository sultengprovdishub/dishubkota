@extends('layouts.admin')
@section('title', 'Manajemen Halte')
@section('page-title', 'Halte Bus Trans Palu')
@section('page-subtitle', 'Kelola titik-titik halte per koridor')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div></div>
        <a href="{{ route('admin.halte.create') }}" class="btn-primary">
            <i class="bx bx-plus"></i> Tambah Halte
        </a>
    </div>

    @if(session('success'))
        <div
            class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-2">
            <i class="bx bx-check-circle text-lg"></i> {{ session('success') }}
        </div>
    @endif

    @forelse($koridor as $k)
        <div class="bg-white rounded-2xl shadow-card overflow-hidden mb-6">
            {{-- Koridor Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100"
                style="border-left: 4px solid {{ $k->warna }};">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl flex items-center justify-center text-white text-xs font-bold"
                        style="background:{{ $k->warna }};">{{ $k->kode }}</span>
                    <div>
                        <div class="font-semibold text-gray-900 text-sm">{{ $k->nama }}</div>
                        <div class="text-xs text-gray-400">{{ $k->halte->count() }} halte</div>
                    </div>
                </div>
                <a href="{{ route('admin.halte.create', ['koridor_id' => $k->id]) }}"
                    class="text-xs text-primary-600 hover:text-primary-700 font-semibold flex items-center gap-1">
                    <i class="bx bx-plus"></i> Tambah Halte
                </a>
            </div>

            @if($k->halte->isEmpty())
                <div class="px-6 py-8 text-center text-gray-400 text-sm">
                    <i class="bx bx-map-pin text-3xl mb-1"></i>
                    <p>Belum ada halte di koridor ini.</p>
                </div>
            @else
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Halte
                            </th>
                            <th
                                class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Koordinat</th>
                            <th
                                class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Tipe</th>
                            <th class="text-right px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($k->halte as $halte)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-3 text-gray-400 text-xs">{{ $halte->urutan }}</td>
                                <td class="px-6 py-3 font-medium text-gray-900">{{ $halte->nama }}</td>
                                <td class="px-6 py-3 hidden md:table-cell">
                                    @if($halte->latitude && $halte->longitude)
                                        <span class="text-xs text-gray-500 font-mono">
                                            {{ number_format($halte->latitude, 6) }}, {{ number_format($halte->longitude, 6) }}
                                        </span>
                                    @else
                                        <span class="text-xs text-red-400">Belum ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 hidden md:table-cell">
                                    <span
                                        class="badge
                                            {{ $halte->tipe === 'terminal' ? 'bg-orange-100 text-orange-700' :
                                ($halte->tipe === 'hub' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700') }}">
                                        {{ ucfirst($halte->tipe) }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.halte.edit', $halte) }}"
                                            class="p-1.5 text-primary-600 hover:bg-primary-50 rounded-lg transition-colors"
                                            title="Edit">
                                            <i class="bx bx-edit text-base"></i>
                                        </a>
                                        <form action="{{ route('admin.halte.destroy', $halte) }}" method="POST"
                                            onsubmit="return confirm('Hapus halte {{ $halte->nama }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                <i class="bx bx-trash text-base"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @empty
        <div class="bg-white rounded-2xl shadow-card p-16 text-center text-gray-400">
            <i class="bx bx-map text-6xl mb-3"></i>
            <p>Belum ada koridor. Tambah koridor terlebih dahulu.</p>
            <a href="{{ route('admin.koridor.create') }}" class="btn-primary mt-4 inline-flex">Tambah Koridor</a>
        </div>
    @endforelse
@endsection