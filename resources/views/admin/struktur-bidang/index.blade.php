<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Kelola Section (Baris)') }}</h2>
                <p class="text-muted small mb-0">Drag-and-drop untuk mengubah urutan baris di halaman depan.</p>
            </div>
            <a href="{{ route('admin.struktur-bidang.create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus me-2"></i> {{ __('Tambah Section Baru') }}
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
                            <th style="width: 5%;">Urutan</th>
                            <th>Nama Section / Baris</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bidang-list">
                        @forelse ($bidangs as $bidang)
                            <tr data-id="{{ $bidang->id }}">
                                <td class="drag-handle" style="cursor: grab;"><i class="fas fa-arrows-alt"></i> {{ $bidang->urutan }}</td>
                                <td>{{ $bidang->nama_bidang }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.struktur-bidang.edit', $bidang) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.struktur-bidang.destroy', $bidang) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus? Ini akan menghapus SEMUA anggota di dalamnya.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center p-4 text-muted">Belum ada data section.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const list = document.getElementById('bidang-list');
            if (list) {
                new Sortable(list, {
                    animation: 150,
                    handle: '.drag-handle',
                    onEnd: function (evt) {
                        const items = list.querySelectorAll('tr[data-id]');
                        const order = Array.from(items).map(item => item.dataset.id);
                        
                        fetch('{{ route("admin.struktur-bidang.updateOrder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ order: order })
                        }).catch(error => console.error('Error:', error));
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>