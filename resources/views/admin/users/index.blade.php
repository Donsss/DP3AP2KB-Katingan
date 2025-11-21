<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Manajemen User') }}</h2>
                <p class="text-muted small mb-0">Kelola akun admin dan super admin.</p>
            </div>
            
            {{-- KUMPULKAN TOMBOL DI SINI --}}
            <div class="d-flex">
                <a href="{{ route('admin.users.trash') }}" class="btn btn-outline-secondary d-flex align-items-center me-2">
                    <i class="fas fa-trash-alt me-2"></i> {{ __('Tempat Sampah') }}
                </a>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="fas fa-plus me-2"></i> {{ __('Tambah User Baru') }}
                </a>
            </div>
            
        </div>
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

    {{-- Notifikasi Sukses Pembuatan Akun (dari Langkah 6) --}}
    @if(session('newUser'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">User Baru Dibuat!</h4>
            <p>Akun telah berhasil dibuat. Berikan info login ini kepada user:</p>
            <hr>
            <p class="mb-1"><strong>Email:</strong> {{ session('newUser')['email'] }}</p>
            <p class="mb-0"><strong>Password:</strong> <span id="new-password">{{ session('newUser')['password'] }}</span>
                <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('#new-password')">
                    <i class="fas fa-copy"></i> Copy
                </button>
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 1. Kartu Statistik --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-3">
                <h3 class="fw-bolder mb-0">{{ $stats['total'] }}</h3>
                <p class="text-muted mb-0">Total User</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-3">
                <h3 class="fw-bolder mb-0 text-danger">{{ $stats['superadmin'] }}</h3>
                <p class="text-muted mb-0">Super Admin</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-3">
                <h3 class="fw-bolder mb-0 text-primary">{{ $stats['admin'] }}</h3>
                <p class="text-muted mb-0">Admin</p>
            </div>
        </div>
    </div>

    {{-- 2. Tabel User --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Terakhir Dilihat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{-- Ambil role pertama, beri style beda --}}
                                    @if($user->getRoleNames()->first() == 'super admin')
                                        <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill">{{ $user->getRoleNames()->first() }}</span>
                                    @else
                                        <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill">{{ $user->getRoleNames()->first() }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $user->last_seen ? $user->last_seen->diffForHumans() : 'Belum pernah' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.users.edit', $user) }}" 
                                       class="btn btn-sm btn-outline-primary @if(Auth::id() == $user->id) disabled @endif" 
                                       title="Edit"
                                       @if(Auth::id() == $user->id) 
                                           aria-disabled="true" 
                                           data-bs-toggle="tooltip" 
                                           data-bs-title="Tidak dapat mengedit diri sendiri" 
                                       @endif>
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                title="Hapus"
                                                @if(Auth::id() == $user->id) 
                                                    disabled 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-title="Tidak dapat menghapus diri sendiri" 
                                                @endif>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-4 text-muted">Belum ada data user.</td>
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
    
    @push('scripts')
    <script>
        function copyToClipboard(elementSelector) {
            const passwordSpan = document.querySelector(elementSelector);
            if (passwordSpan) {
                navigator.clipboard.writeText(passwordSpan.innerText).then(() => {
                    alert('Password disalin ke clipboard!');
                }).catch(err => {
                    alert('Gagal menyalin. Coba lagi.');
                });
            }
        }
    </script>
    <script>
        // Inisialisasi Tooltip Bootstrap (diperlukan untuk 'disabled')
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
    @endpush
</x-app-layout>