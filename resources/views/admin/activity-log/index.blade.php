<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Log Aktivitas') }}
        </h2>
    </x-slot>

    {{-- Tampilkan Alert Sukses jika ada --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
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
                            <th>Aktivitas</th>
                            <th>Oleh</th>
                            <th>Waktu</th>
                            {{-- Tambahkan Header Aksi --}}
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $activity)
                            <tr>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->causer ? $activity->causer->name : 'Sistem' }}</td>
                                <td>{{ $activity->created_at->format('d M Y, H:i') }}</td>
                                {{-- Tambahkan Tombol Hapus --}}
                                <td class="text-end">
                                    <form action="{{ route('admin.activity-log.destroy', $activity->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus log ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada aktivitas tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</x-app-layout>