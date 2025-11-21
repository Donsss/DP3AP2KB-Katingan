<div class="mb-3">
    <label for="judul" class="form-label">Judul (Cth: S3 - Ilmu Kesehatan)</label>
    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $riwayat->judul ?? '') }}" required>
    @error('judul')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan (Cth: Lulus 2010)</label>
    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan', $riwayat->keterangan ?? '') }}" required>
    @error('keterangan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi (Cth: Universitas Gadjah Mada)</label>
    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $riwayat->deskripsi ?? '') }}" required>
    @error('deskripsi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="urutan" class="form-label">Nomor Urut (untuk sorting, cth: 1, 2, 3)</label>
    <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', $riwayat->urutan ?? 0) }}" required>
    @error('urutan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>