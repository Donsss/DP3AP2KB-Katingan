<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0">{{ __('Manajemen Bidang') }}</h2>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Kolom Kiri: Form Tambah Bidang --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="mb-0">Tambah Bidang Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('bidang.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Bidang</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @else
                                <div class="form-text">Slug akan dibuat secara otomatis.</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Bidang</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Daftar Bidang --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th class="text-center">Jumlah Pegawai</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bidangs as $bidang)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $bidang->name }}</div>
                                            <small class="text-muted">{{ $bidang->slug }}</small>
                                        </td>
                                        <td class="text-center">{{ $bidang->pegawais_count }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('bidang.edit', $bidang) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('bidang.destroy', $bidang) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus bidang ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted p-4">Belum ada bidang. Mulai dengan menambahkan satu!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $bidangs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
