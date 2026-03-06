<div class="space-y-5">
    {{-- Kode --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kode <span class="text-red-500">*</span></label>
            <input type="text" name="kode" value="{{ old('kode', $koridor->kode ?? '') }}"
                   required placeholder="K01" maxlength="10"
                   class="input-field @error('kode') border-red-400 @enderror">
            @error('kode') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
            <input type="number" name="urutan" value="{{ old('urutan', $koridor->urutan ?? 0) }}"
                   min="0" class="input-field">
        </div>
    </div>

    {{-- Nama --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Koridor <span class="text-red-500">*</span></label>
        <input type="text" name="nama" value="{{ old('nama', $koridor->nama ?? '') }}"
               required placeholder="Koridor 01 — Terminal Mamboro — Manonda"
               class="input-field @error('nama') border-red-400 @enderror">
        @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Warna --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Warna Garis <span class="text-red-500">*</span></label>
        <div class="flex items-center gap-3">
            <input type="color" name="warna" id="warna-picker"
                   value="{{ old('warna', $koridor->warna ?? '#3b82f6') }}"
                   class="w-12 h-10 rounded-lg border border-gray-200 cursor-pointer p-0.5"
                   oninput="document.getElementById('warna-hex').value=this.value">
            <input type="text" id="warna-hex"
                   value="{{ old('warna', $koridor->warna ?? '#3b82f6') }}"
                   placeholder="#3b82f6" maxlength="20"
                   class="input-field flex-1 font-mono text-sm"
                   oninput="document.getElementById('warna-picker').value=this.value"
                   onchange="document.getElementById('warna-picker').value=this.value">
        </div>
        <p class="text-xs text-gray-400 mt-1">Warna ini akan ditampilkan pada garis peta dan legenda.</p>
        {{-- Hidden input yang dikirim --}}
        <script>
            document.getElementById('warna-picker').addEventListener('input', function() {
                document.querySelector('input[name="warna"]').value = this.value;
            });
        </script>
        {{-- Override nama field --}}
        <input type="hidden" name="warna" id="warna-val" value="{{ old('warna', $koridor->warna ?? '#3b82f6') }}">
    </div>

    {{-- Deskripsi --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
        <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat koridor ini..."
                  class="input-field resize-none">{{ old('deskripsi', $koridor->deskripsi ?? '') }}</textarea>
    </div>

    {{-- Aktif --}}
    <div class="flex items-center gap-3">
        <input type="checkbox" name="aktif" id="aktif" value="1"
               {{ old('aktif', $koridor->aktif ?? true) ? 'checked' : '' }}
               class="w-4 h-4 text-primary-600 rounded">
        <label for="aktif" class="text-sm font-semibold text-gray-700 cursor-pointer">Koridor Aktif</label>
    </div>
</div>

<script>
// Sync color picker ↔ hex input
const picker = document.getElementById('warna-picker');
const hexInput = document.getElementById('warna-hex');
const hiddenVal = document.getElementById('warna-val');

picker.addEventListener('input', function() {
    hexInput.value = this.value;
    hiddenVal.value = this.value;
});
hexInput.addEventListener('input', function() {
    if (/^#[0-9a-fA-F]{6}$/.test(this.value)) {
        picker.value = this.value;
    }
    hiddenVal.value = this.value;
});
</script>
