<div class="space-y-5">
    <div class="grid grid-cols-2 gap-4">
        {{-- Kunci --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kunci (ID unik) <span
                    class="text-red-500">*</span></label>
            <input type="text" name="kunci" value="{{ old('kunci', $spesifikasiBus->kunci ?? '') }}" required
                placeholder="kapasitas" maxlength="50"
                class="input-field font-mono text-sm @error('kunci') border-red-400 @enderror">
            @error('kunci') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            <p class="text-xs text-gray-400 mt-1">Huruf kecil tanpa spasi, contoh: kapasitas, kursi</p>
        </div>
        {{-- Urutan --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan Tampil</label>
            <input type="number" name="urutan" value="{{ old('urutan', $spesifikasiBus->urutan ?? 0) }}" min="0"
                class="input-field">
        </div>
    </div>

    {{-- Label --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Label <span
                class="text-red-500">*</span></label>
        <input type="text" name="label" value="{{ old('label', $spesifikasiBus->label ?? '') }}" required
            placeholder="Kapasitas Total" class="input-field @error('label') border-red-400 @enderror">
        @error('label') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Nilai --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nilai <span
                class="text-red-500">*</span></label>
        <input type="text" name="nilai" value="{{ old('nilai', $spesifikasiBus->nilai ?? '') }}" required
            placeholder="35 Penumpang" class="input-field @error('nilai') border-red-400 @enderror">
        @error('nilai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Ikon --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ikon (Boxicons class) <span
                class="text-red-500">*</span></label>
        <div class="flex items-center gap-3">
            <div id="ikon-preview" class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center shrink-0">
                <i id="ikon-preview-i"
                    class="{{ old('ikon', $spesifikasiBus->ikon ?? 'bx bx-info-circle') }} text-xl text-gray-500"></i>
            </div>
            <input type="text" name="ikon" id="ikon-input"
                value="{{ old('ikon', $spesifikasiBus->ikon ?? 'bx bx-info-circle') }}" required
                placeholder="bx bx-user-plus" class="input-field font-mono text-sm"
                oninput="document.getElementById('ikon-preview-i').className=this.value+' text-xl text-gray-500'">
        </div>
        <p class="text-xs text-gray-400 mt-1">Contoh: bx bx-user-plus, bx bx-route, bx bx-map-pin
            — Lihat <a href="https://boxicons.com" target="_blank" class="text-primary-500 underline">boxicons.com</a>
        </p>
    </div>

    {{-- Warna --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Warna Ikon <span
                    class="text-red-500">*</span></label>
            <div class="flex items-center gap-2">
                <input type="color" id="warna-picker" value="{{ old('warna', $spesifikasiBus->warna ?? '#3b82f6') }}"
                    class="w-10 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5"
                    oninput="document.getElementById('warna-input').value=this.value">
                <input type="text" name="warna" id="warna-input"
                    value="{{ old('warna', $spesifikasiBus->warna ?? '#3b82f6') }}" placeholder="#3b82f6" maxlength="20"
                    class="input-field flex-1 font-mono text-sm"
                    oninput="if(/^#[0-9a-fA-F]{6}$/.test(this.value))document.getElementById('warna-picker').value=this.value">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Warna Background <span
                    class="text-red-500">*</span></label>
            <input type="text" name="warna_bg"
                value="{{ old('warna_bg', $spesifikasiBus->warna_bg ?? 'rgba(59,130,246,0.08)') }}" required
                placeholder="rgba(59,130,246,0.08)" class="input-field font-mono text-sm">
            <p class="text-xs text-gray-400 mt-1">Format rgba() atau hex</p>
        </div>
    </div>
</div>