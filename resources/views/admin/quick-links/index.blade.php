<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 font-weight-bold">{{ __('Tautan Cepat Footer') }}</h2>
            <a href="{{ route('quick-links.create') }}" class="btn btn-primary">Tambah Tautan Baru</a>
        </div>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <p class="text-muted">Tarik dan lepas baris untuk mengubah urutan. Urutan akan tersimpan otomatis.</p>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px;">Urutan</th>
                        <th>Judul Tautan</th>
                        <th>URL</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sortable-links">
                    @forelse($links as $link)
                        <tr data-id="{{ $link->id }}">
                            <td class="text-center align-middle" style="cursor: move;">
                                <i class="fas fa-grip-vertical"></i>
                            </td>
                            <td class="align-middle">{{ $link->title }}</td>
                            <td class="align-middle">
                                <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('quick-links.edit', $link) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('quick-links.destroy', $link) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada tautan. Silakan buat baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('sortable-links');
            if (el) {
                const sortable = Sortable.create(el, {
                    animation: 150,
                    handle: '.fa-grip-vertical', // Hanya bisa di-drag via ikon
                    onEnd: function (evt) {
                        // Dapatkan urutan ID yang baru
                        const order = Array.from(sortable.el.rows).map(row => row.dataset.id);

                        // Kirim data ke server via AJAX (Fetch API)
                        fetch('{{ route("quick-links.updateOrder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ order: order })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // (Opsional) Tampilkan notifikasi sukses
                                console.log(data.message);
                            } else {
                                alert('Gagal menyimpan urutan.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan.');
                        });
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>