<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Lihat Pesan') }}</h2>
    </x-slot>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $message->subject ?? '(Tanpa Subjek)' }}</h5>
                    <a href="{{ route('contact-messages.index') }}" class="btn btn-secondary">&larr; Kembali ke Pesan Masuk</a>
                </div>
                <div class="card-body">
                    <p class="fs-5">{{ $message->message }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="mb-0">Detail Pengirim</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong class="d-block">Nama:</strong>
                        <span>{{ $message->name }}</span>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block">Email:</strong>
                        <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                    </div>
                    <div class="mb-3">
                        <strong class="d-block">IP Address:</strong>
                        <span class="text-muted">{{ $message->ip_address ?? 'N/A' }}</span>
                    </div>
                    <div class="mb-0">
                        <strong class="d-block">Diterima:</strong>
                        <span class="text-muted">{{ $message->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <form action="{{ route('contact-messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus pesan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Hapus Pesan Ini
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>