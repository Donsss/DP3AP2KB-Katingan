<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Pesan Masuk') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Subjek</th>
                            <th>Status</th>
                            <th>Diterima</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr class="{{ $message->status == 'unread' ? 'fw-bold' : '' }}">
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->subject ?? '(Tanpa Subjek)' }}</td>
                                <td>
                                    @if($message->status == 'unread')
                                        <span class="badge bg-primary">Baru</span>
                                    @else
                                        <span class="badge bg-secondary">Dibaca</span>
                                    @endif
                                </td>
                                <td>{{ $message->created_at->diffForHumans() }}</td>
                                <td class="text-end">
                                    <a href="{{ route('contact-messages.show', $message) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <form action="{{ route('contact-messages.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus pesan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada pesan masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</x-app-layout>