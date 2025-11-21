<div class="mb-3">
    <label for="nama_bidang" class="form-label">Nama Section / Baris</label>
    <input type="text" class="form-control @error('nama_bidang') is-invalid @enderror" id="nama_bidang" name="nama_bidang" value="{{ old('nama_bidang', $strukturBidang->nama_bidang ?? '') }}" required>
    <div class="form-text">Cth: "Level 1: Pimpinan", "Level 2: Sekretariat", "Level 3: Bidang-Bidang"</div>
    @error('nama_bidang') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" role="switch" id="is_shifted" name="is_shifted" value="1" 
        {{ (old('is_shifted', $strukturBidang->is_shifted ?? false)) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_shifted">Geser Baris ini ke Kanan (Efek "Shifted")</label>
    <div class="form-text">Ini akan memberi class 'level-2-shifted' pada baris ini di halaman depan (frontend).</div>
</div>