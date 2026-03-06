<div class="space-y-5">
    {{-- Judul --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Berita <span
                class="text-red-500">*</span></label>
        <input type="text" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" required
            placeholder="Masukkan judul berita" class="input-field @error('judul') border-red-400 @enderror">
        @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Ringkasan --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ringkasan</label>
        <textarea name="ringkasan" rows="3" placeholder="Ringkasan singkat (opsional)"
            class="input-field resize-none">{{ old('ringkasan', $berita->ringkasan ?? '') }}</textarea>
    </div>

    {{-- Konten --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konten <span
                class="text-red-500">*</span></label>
        <textarea name="konten" id="konten" rows="12"
            class="input-field resize-y font-mono text-sm @error('konten') border-red-400 @enderror"
            placeholder="Tulis konten berita di sini (HTML diperbolehkan)...">{{ old('konten', $berita->konten ?? '') }}</textarea>
        @error('konten') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Thumbnail --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Thumbnail</label>
        @if(isset($berita) && $berita->thumbnail)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $berita->thumbnail) }}"
                    class="w-40 h-28 object-cover rounded-xl border border-gray-200">
                <p class="text-xs text-gray-500 mt-1">Thumbnail saat ini. Upload baru untuk mengganti.</p>
            </div>
        @endif
        <input type="file" name="thumbnail" accept="image/*"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-all">
    </div>

    {{-- Kategori & Status --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span
                    class="text-red-500">*</span></label>
            <input type="text" name="kategori" value="{{ old('kategori', $berita->kategori ?? 'Umum') }}" required
                list="kategori-list" class="input-field">
            <datalist id="kategori-list">
                <option value="Umum">
                <option value="Kegiatan">
                <option value="Layanan">
                <option value="Pembangunan">
                <option value="Pengumuman">
            </datalist>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status <span
                    class="text-red-500">*</span></label>
            <select name="status" class="input-field">
                <option value="draft" {{ old('status', $berita->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft
                </option>
                <option value="publish" {{ old('status', $berita->status ?? '') === 'publish' ? 'selected' : '' }}>Publish
                </option>
            </select>
        </div>
    </div>

    {{-- Tanggal Publish --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Publikasi</label>
        <input type="datetime-local" name="published_at"
            value="{{ old('published_at', isset($berita) && $berita->published_at ? $berita->published_at->format('Y-m-d\TH:i') : '') }}"
            class="input-field">
        <p class="text-xs text-gray-400 mt-1">Opsional. Jika dikosongkan dan status publish, akan otomatis menggunakan
            waktu sekarang.</p>
    </div>
</div>