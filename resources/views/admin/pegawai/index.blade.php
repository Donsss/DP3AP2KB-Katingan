<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Daftar Pegawai') }}</h2>
                <p class="text-muted small mb-0">Atur urutan pegawai dengan drag-and-drop.</p>
            </div>
            <a href="{{ route('admin.pegawai.create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus me-2"></i> {{ __('Tambah Pegawai Baru') }}
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse ($bidangs as $bidang)
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h5 class="mb-0">{{ $bidang->name }}</h5>
                    </div>
                    <div class="list-group list-group-flush pegawai-sortable" data-bidang-id="{{ $bidang->id }}">
                        @forelse ($bidang->pegawais as $pegawai)
                            <div class="list-group-item d-flex align-items-center" data-id="{{ $pegawai->id }}">
                                <i class="fas fa-arrows-alt text-muted drag-handle me-3" style="cursor: grab;"></i>
                                <img src="{{ asset('storage/' . $pegawai->photo) }}" class="rounded me-3" alt="{{ $pegawai->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ $pegawai->name }}</div>
                                    <small class="text-muted">{{ $pegawai->position }}</small><br>
                                    <small class="text-muted">NIP: {{ $pegawai->nip }}</small>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('admin.pegawai.edit', $pegawai) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pegawai.destroy', $pegawai) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item text-center text-muted p-4">
                                Belum ada pegawai di bidang ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center p-5 bg-light rounded">
                    <h4 class="font-weight-bold">Belum Ada Bidang</h4>
                    <p class="text-muted">Silakan tambahkan data bidang terlebih dahulu.</p>
                    <a href="{{ route('bidangs.index') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-plus me-2"></i> Tambah Bidang
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    @push('scripts')
    {{-- Memuat SortableJS dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortableLists = document.querySelectorAll('.pegawai-sortable');

            sortableLists.forEach(list => {
                new Sortable(list, {
                    animation: 150,
                    handle: '.drag-handle', // Elemen yang bisa ditarik
                    onEnd: function (evt) {
                        const items = list.querySelectorAll('[data-id]');
                        const order = Array.from(items).map(item => item.dataset.id);

                        // Kirim urutan baru ke server via AJAX
                        fetch('{{ route("admin.pegawai.updateOrder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ order: order })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.status === 'success') {
                                console.log(data.message);
                                // Opsional: Tampilkan notifikasi toast "Urutan disimpan"
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
