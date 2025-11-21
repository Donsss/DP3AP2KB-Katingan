{{-- 
    File partial ini digunakan oleh create.blade.php dan edit.blade.php
    Variabel $riwayat akan ada jika dipanggil dari 'edit', dan tidak ada jika dari 'create'.
    Kita gunakan '?? null' untuk menanganinya.
--}}

<div class="mb-3">
    <label for="judul" class="form-label">Judul (Cth: Kepala Dinas DP3A)</label>
    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $riwayat->judul ?? null) }}" required>
    @error('judul')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan (Cth: 2020 - Sekarang)</label>
    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan', $riwayat->keterangan ?? null) }}" required>
    @error('keterangan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="urutan" class="form-label">Nomor Urut</label>
    <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', $riwayat->urutan ?? 0) }}" required>
    <div class="form-text">Angka yang lebih kecil akan tampil di urutan bawah (data lama). Angka lebih besar tampil di urutan atas (data baru).</div>
    @error('urutan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>