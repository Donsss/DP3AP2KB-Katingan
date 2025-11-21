<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Tempat Sampah User') }}</h2>
                <p class="text-muted small mb-0">User yang sudah dihapus (soft delete). Pulihkan atau hapus permanen.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                <i class="fas fa-arrow-left me-2"></i> {{ __('Kembali ke Daftar User') }}
            </a>
        </div>
    </x-slot>

    {{-- Notifikasi Sukses/Error --}}
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
    
    {{-- Tabel User yang Terhapus --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Dihapus</th> {{-- <-- Diubah --}}
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user) {{-- $users ini dikirim dari method trash() --}}
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{-- Tampilkan role --}}
                                    @if($user->getRoleNames()->first() == 'super admin')
                                        <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill">{{ $user->getRoleNames()->first() }}</span>
                                    @else
                                        <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill">{{ $user->getRoleNames()->first() }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Tampilkan kapan dihapusnya --}}
                                    {{ $user->deleted_at ? $user->deleted_at->diffForHumans() : 'N/A' }}
                                </td>
                                
                                {{-- Tombol Aksi (Restore & Hapus Permanen) --}}
                                <td class="text-center">
                                    {{-- Tombol RESTORE --}}
                                    <form action="{{ route('admin.users.restore', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin me-restore user ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-success" 
                                                title="Restore User">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    
                                    {{-- Tombol HAPUS PERMANEN --}}
                                    <form action="{{ route('admin.users.forceDelete', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('PERINGATAN: Ini akan menghapus data selamanya. Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger" 
                                                title="Hapus Permanen">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4 text-muted">Tempat sampah kosong.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    
</x-app-layout>