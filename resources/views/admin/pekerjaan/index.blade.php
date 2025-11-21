<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Riwayat Pekerjaan') }}</h2>
                <p class="text-muted small mb-0">Kelola riwayat pekerjaan pimpinan.</p>
            </div>
            <a href="{{ route('admin.pekerjaan.create') }}" class="btn btn-primary d-flex align-items-center">
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
                            <th style="width: 10%;">Urutan</th>
                            <th>Judul (Jabatan)</th>
                            <th>Keterangan (Masa Jabatan)</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayats as $riwayat)
                            <tr>
                                <td><span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill px-2">{{ $riwayat->urutan }}</span></td>
                                <td>{{ $riwayat->judul }}</td>
                                <td>{{ $riwayat->keterangan }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.pekerjaan.edit', $riwayat) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pekerjaan.destroy', $riwayat) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-4">
                                    <p class="mb-0 text-muted">Belum ada data riwayat pekerjaan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($riwayats->hasPages())
                <div class="mt-3">
                    {{ $riwayats->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>