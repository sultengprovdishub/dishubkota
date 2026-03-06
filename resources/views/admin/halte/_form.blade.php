@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css">
    <style>
        #map-picker {
            height: 350px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .leaflet-control-zoom {
            border-radius: 8px !important;
        }
    </style>
@endpush

<div class="space-y-5">
    {{-- Koridor --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Koridor <span
                class="text-red-500">*</span></label>
        <select name="koridor_id" class="input-field @error('koridor_id') border-red-400 @enderror" required>
            <option value="">-- Pilih Koridor --</option>
            @foreach($koridor_list as $k)
                <option value="{{ $k->id }}" {{ old('koridor_id', $halte->koridor_id ?? ($selected_koridor->id ?? '')) == $k->id ? 'selected' : '' }}>
                    [{{ $k->kode }}] {{ $k->nama }}
                </option>
            @endforeach
        </select>
        @error('koridor_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Nama --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Halte <span
                class="text-red-500">*</span></label>
        <input type="text" name="nama" value="{{ old('nama', $halte->nama ?? '') }}" required
            placeholder="Terminal Mamboro" class="input-field @error('nama') border-red-400 @enderror">
        @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Tipe & Urutan --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tipe <span
                    class="text-red-500">*</span></label>
            <select name="tipe" class="input-field" required>
                <option value="halte" {{ old('tipe', $halte->tipe ?? 'halte') === 'halte' ? 'selected' : '' }}>Halte Biasa
                </option>
                <option value="terminal" {{ old('tipe', $halte->tipe ?? '') === 'terminal' ? 'selected' : '' }}>Terminal
                </option>
                <option value="hub" {{ old('tipe', $halte->tipe ?? '') === 'hub' ? 'selected' : '' }}>Hub / Transfer
                </option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
            <input type="number" name="urutan" value="{{ old('urutan', $halte->urutan ?? 0) }}" min="0"
                class="input-field">
        </div>
    </div>

    {{-- Map Picker --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
            <i class="bx bx-map-pin text-primary-500"></i> Lokasi di Peta
            <span class="text-gray-400 font-normal text-xs ml-1">— Klik peta atau drag marker untuk menentukan
                koordinat</span>
        </label>
        <div class="bg-gray-50 rounded-xl p-3 border border-gray-200 mb-3">
            <div id="map-picker"></div>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Latitude</label>
                <input type="number" name="latitude" id="lat-input" step="0.0000001"
                    value="{{ old('latitude', $halte->latitude ?? '') }}" required placeholder="-0.8359000"
                    class="input-field font-mono text-sm @error('latitude') border-red-400 @enderror">
                @error('latitude') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Longitude</label>
                <input type="number" name="longitude" id="lng-input" step="0.0000001"
                    value="{{ old('longitude', $halte->longitude ?? '') }}" required placeholder="119.8562000"
                    class="input-field font-mono text-sm @error('longitude') border-red-400 @enderror">
                @error('longitude') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>
    <script>
        (function () {
            const defaultLat = parseFloat(document.getElementById('lat-input').value) || -0.8650;
            const defaultLng = parseFloat(document.getElementById('lng-input').value) || 119.8683;

            // Init map
            const map = L.map('map-picker').setView([defaultLat, defaultLng], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap', maxZoom: 19
            }).addTo(map);

            // Init marker
            const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

            function updateInputs(lat, lng) {
                document.getElementById('lat-input').value = lat.toFixed(7);
                document.getElementById('lng-input').value = lng.toFixed(7);
            }

            // Drag marker
            marker.on('dragend', function (e) {
                const { lat, lng } = e.target.getLatLng();
                updateInputs(lat, lng);
            });

            // Click map
            map.on('click', function (e) {
                const { lat, lng } = e.latlng;
                marker.setLatLng([lat, lng]);
                updateInputs(lat, lng);
            });

            // Manual input → move marker
            function syncFromInputs() {
                const lat = parseFloat(document.getElementById('lat-input').value);
                const lng = parseFloat(document.getElementById('lng-input').value);
                if (!isNaN(lat) && !isNaN(lng)) {
                    marker.setLatLng([lat, lng]);
                    map.panTo([lat, lng]);
                }
            }
            document.getElementById('lat-input').addEventListener('change', syncFromInputs);
            document.getElementById('lng-input').addEventListener('change', syncFromInputs);

            // Resize map after render
            setTimeout(() => map.invalidateSize(), 200);
        })();
    </script>
@endpush