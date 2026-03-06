@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')
@section('page-subtitle', 'Pesan dari form kontak publik')
@section('content')
    <div class="bg-white rounded-2xl shadow-card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Pengirim</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase hidden md:table-cell">
                        Subjek</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase hidden md:table-cell">Waktu
                    </th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($pesan as $item)
                    <tr class="hover:bg-gray-50 transition-colors {{ !$item->dibaca ? 'bg-blue-50/40 font-semibold' : '' }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if(!$item->dibaca)
                                    <span class="w-2 h-2 rounded-full bg-blue-500 shrink-0"></span>
                                @else
                                    <span class="w-2 h-2 shrink-0"></span>
                                @endif
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $item->nama }}</div>
                                    <div class="text-xs text-gray-400">{{ $item->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700 hidden md:table-cell">{{ Str::limit($item->subjek, 55) }}</td>
                        <td class="px-6 py-4 text-gray-400 text-xs hidden md:table-cell">
                            {{ optional($item->created_at)->diffForHumans() }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.kontak.show', $item) }}"
                                    class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg" title="Lihat">
                                    <i class="bx bx-show text-lg"></i>
                                </a>
                                <form action="{{ route('admin.kontak.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Hapus pesan?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><i
                                            class="bx bx-trash text-lg"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-gray-400"><i
                                class="bx bx-envelope text-5xl mb-2"></i>
                            <p>Belum ada pesan masuk.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-100">{{ $pesan->links() }}</div>
    </div>
@endsection