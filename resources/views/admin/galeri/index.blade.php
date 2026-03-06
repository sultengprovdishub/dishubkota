@extends('layouts.admin')
@section('title', 'Manajemen Galeri')
@section('page-title', 'Galeri Foto')
@section('page-subtitle', 'Kelola dokumentasi kegiatan')

@section('content')
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.galeri.create') }}" class="btn-primary"><i class="bx bx-plus"></i> Upload Foto</a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @forelse($galeri as $item)
            <div class="bg-white rounded-2xl shadow-card overflow-hidden group">
                <div class="relative aspect-square overflow-hidden">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div
                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                        <a href="{{ route('admin.galeri.edit', $item) }}"
                            class="p-2 bg-white/90 rounded-lg text-primary-700 hover:bg-white">
                            <i class="bx bx-edit text-lg"></i>
                        </a>
                        <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST"
                            onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 bg-white/90 rounded-lg text-red-600 hover:bg-white"><i
                                    class="bx bx-trash text-lg"></i></button>
                        </form>
                    </div>
                </div>
                <div class="p-3">
                    <p class="text-xs font-semibold text-gray-900 line-clamp-1">{{ $item->judul }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl shadow-card p-16 text-center text-gray-400">
                <i class="bx bx-images text-6xl mb-3"></i>
                <p>Belum ada foto.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-6 flex justify-center">{{ $galeri->links() }}</div>
@endsection