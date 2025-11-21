<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Kelola Tugas dan Fungsi') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- Menampilkan pesan sukses --}}
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form untuk Upload/Update File --}}
            <form action="{{ route('admin.tugas.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="pdf_file" class="form-label">Upload File PDF Baru</label>
                    <input type="file" name="pdf_file" id="pdf_file" class="form-control @error('pdf_file') is-invalid @enderror" accept=".pdf" required>
                    <div class="form-text">Upload file PDF baru untuk menggantikan yang lama. (Maks: 10MB)</div>
                    @error('pdf_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan dan Publikasikan</button>
            </form>

            <hr class="my-4">

            {{-- Menampilkan File Saat Ini --}}
            <h5>File Saat Ini</h5>
            
            {{-- Cek apakah data dan file fisik ada --}}
            @if ($tugas && $tugas->file_path && Storage::disk('public')->exists($tugas->file_path))
                
                {{-- Tampilan file yang dipercantik --}}
                <div class="card bg-light border-secondary mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            
                            {{-- Info File (Ikon, Nama, Ukuran) --}}
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                                <div>
                                    <h6 class="card-title mb-0">
                                        {{ $tugas->file_name ?? $tugas->file_path }}
                                    </h6>
                                    <small class="text-muted">{{ $tugas->file_size }}</small>
                                </div>
                            </div>
                            
                            {{-- Tombol Aksi (Lihat & Hapus) --}}
                            <div class="d-flex gap-2">
                                {{-- Tombol Lihat --}}
                                <a href="{{ asset('storage/' . $tugas->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Lihat File">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                                
                                {{-- Tombol Hapus (Wajib pakai FORM) --}}
                                <form action="{{ route('admin.tugas.destroy') }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus file ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus File">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <p>Preview Dokumen:</p>
                <div class="pdf-viewer-container shadow-sm mt-3" style="border: 1px solid #dee2e6; border-radius: 0.375rem; overflow: hidden;">
                    <iframe src="{{ asset('storage/' . $tugas->file_path) }}" style="width: 100%; height: 100vh; border: none;"></iframe>
                </div>

            @else
                {{-- Tampilan jika tidak ada file --}}
                <div class="alert alert-warning" role="alert">
                    Belum ada file Tugas dan Fungsi yang di-upload.
                </div>
            @endif

        </div>
    </div>
</x-app-layout>