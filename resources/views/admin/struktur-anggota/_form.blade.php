<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="struktur_bidang_id" class="form-label">Section / Baris</label>
            <select class="form-select @error('struktur_bidang_id') is-invalid @enderror" id="struktur_bidang_id" name="struktur_bidang_id" required>
                <option value="">Pilih Section...</option>
                @foreach($bidangs as $id => $nama)
                    <option value="{{ $id }}" {{ (old('struktur_bidang_id', $anggota->struktur_bidang_id ?? '') == $id) ? 'selected' : '' }}>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>
            @error('struktur_bidang_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Anggota</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $anggota->nama ?? '') }}" required>
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan', $anggota->jabatan ?? '') }}" required>
            @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="nip" class="form-label">NIP (Opsional)</label>
            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip', $anggota->nip ?? '') }}">
            @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            @if(isset($anggota) && $anggota->foto)
                <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto" class="img-fluid rounded mb-2" style="max-height: 200px;">
            @endif
            <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto">
            <div class="form-text">Upload foto baru untuk mengganti (jika ada).</div>
            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        {{-- Opsi A: Spacer Card --}}
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible" value="1" 
                {{ (old('is_visible', $anggota->is_visible ?? true)) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_visible">Tampilkan Kartu Ini</label>
            <div class="form-text">Jika tidak dicentang, kartu ini akan menjadi "spacer" (kartu kosong) di halaman depan.</div>
        </div>
    </div>
</div>