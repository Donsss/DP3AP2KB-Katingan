<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Riwayat Pendidikan') }}</h2>
                <p class="text-muted small mb-0">Kelola riwayat pendidikan pimpinan.</p>
            </div>
            <a href="{{ route('admin.pendidikan.create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus me-2"></i> {{ __('Tambah Riwayat') }}
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Judul (Gelar)</th>
                            <th>Keterangan (Lulus)</th>
                            <th>Deskripsi (Institusi)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayats as $riwayat)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $riwayat->urutan }}</span></td>
                                <td>{{ $riwayat->judul }}</td>
                                <td>{{ $riwayat->keterangan }}</td>
                                <td>{{ $riwayat->deskripsi }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.pendidikan.edit', $riwayat) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pendidikan.destroy', $riwayat) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">
                                    <p class="mb-0 text-muted">Belum ada data riwayat pendidikan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $riwayats->links() }}
            </div>
        </div>
    </div>
</x-app-layout>