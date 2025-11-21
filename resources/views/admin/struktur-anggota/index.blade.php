<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Kelola Anggota (Kartu)') }}</h2>
                <p class="text-muted small mb-0">Drag-and-drop kartu di dalam section-nya untuk mengubah urutan.</p>
            </div>
            <a href="{{ route('admin.struktur-anggota.create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus me-2"></i> {{ __('Tambah Anggota Baru') }}
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Looping per Section/Bidang --}}
    @forelse ($bidangs as $bidang)
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">{{ $bidang->nama_bidang }} ({{ $bidang->anggota->count() }} Anggota)</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 sortable-list" id="bidang-list-{{ $bidang->id }}" data-bidang-id="{{ $bidang->id }}">
                    
                    {{-- Looping per Anggota/Kartu --}}
                    @forelse ($bidang->anggota as $anggota)
                        <div class="col-md-3" data-id="{{ $anggota->id }}">
                            <div class="card h-100 {{ !$anggota->is_visible ? 'bg-light border-dashed' : '' }}">
                                <div class="card-body p-2 d-flex">
                                    <div class="drag-handle" style="cursor: grab; padding: 0.5rem;">
                                        <i class="fas fa-arrows-alt text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        @if($anggota->is_visible)
                                            <h6 class="mb-0">{{ $anggota->nama }}</h6>
                                            <small class="text-muted">{{ $anggota->jabatan }}</small>
                                        @else
                                            <h6 class="mb-0 text-muted fst-italic">[SPACER CARD]</h6>
                                            <small class="text-muted">Kartu Kosong (Tersembunyi)</small>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column gap-1">
                                        <a href="{{ route('admin.struktur-anggota.edit', $anggota) }}" class="btn btn-sm btn-outline-primary px-1 py-0" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.struktur-anggota.destroy', $anggota) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-1 py-0" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted text-center">Belum ada anggota di section ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @empty
        <div class="text-center p-5 bg-light rounded">
            <h4 class="font-weight-bold">Belum Ada Section</h4>
            <p class="text-muted">Harap buat "Section" (Baris) terlebih dahulu di menu "Kelola Section".</p>
            <a href="{{ route('admin.struktur-bidang.create') }}" class="btn btn-primary mt-2">
                <i class="fas fa-plus me-2"></i> Buat Section Pertama
            </a>
        </div>
    @endforelse
    
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Sortable untuk SETIAP list bidang
            document.querySelectorAll('.sortable-list').forEach(list => {
                new Sortable(list, {
                    animation: 150,
                    handle: '.drag-handle',
                    onEnd: function (evt) {
                        const bidangId = list.dataset.bidangId; // Ambil ID bidang dari list
                        const items = list.querySelectorAll('div[data-id]');
                        const order = Array.from(items).map(item => item.dataset.id);
                        
                        fetch('{{ route("admin.struktur-anggota.updateOrder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            // Kirim ID bidang DAN urutan anggotanya
                            body: JSON.stringify({ 
                                bidang_id: bidangId,
                                order: order 
                            })
                        }).catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>