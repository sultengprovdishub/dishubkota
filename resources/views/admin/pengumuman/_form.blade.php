<div class="space-y-5">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul <span
                class="text-red-500">*</span></label>
        <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul ?? '') }}" required
            class="input-field">
        @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konten <span
                class="text-red-500">*</span></label>
        <textarea name="konten" rows="6" required
            class="input-field resize-y">{{ old('konten', $pengumuman->konten ?? '') }}</textarea>
        @error('konten') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Terbit <span
                    class="text-red-500">*</span></label>
            <input type="date" name="tanggal_terbit"
                value="{{ old('tanggal_terbit', isset($pengumuman) ? optional($pengumuman->tanggal_terbit)->format('Y-m-d') : '') }}"
                required class="input-field">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Berakhir</label>
            <input type="date" name="tanggal_berakhir"
                value="{{ old('tanggal_berakhir', isset($pengumuman) ? optional($pengumuman->tanggal_berakhir)->format('Y-m-d') : '') }}"
                class="input-field">
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status <span
                    class="text-red-500">*</span></label>
            <select name="status" class="input-field">
                <option value="aktif" {{ old('status', $pengumuman->status ?? '') === 'aktif' ? 'selected' : '' }}>Aktif
                </option>
                <option value="nonaktif" {{ old('status', $pengumuman->status ?? '') === 'nonaktif' ? 'selected' : '' }}>
                    Tidak Aktif</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">File Lampiran</label>
            <input type="file" name="file_lampiran"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
        </div>
    </div>
</div>