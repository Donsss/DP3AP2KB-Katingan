<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Documents') }}</h2>
                <p class="text-muted small mb-0">Kelola berkas yang dapat Anda unduh di sini.</p>
            </div>
            <a href="{{ route('documents.create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus me-2"></i> {{ __('Add New Document') }}
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
                            <th style="width: 50%;">Title</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Downloads</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($documents as $document)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="file-icon me-3">
                                            @switch($document->file_type)
                                                @case('pdf')
                                                    <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                                    @break
                                                @case('doc')
                                                @case('docx')
                                                    <i class="fas fa-file-word fa-2x text-primary"></i>
                                                    @break
                                                @case('xls')
                                                @case('xlsx')
                                                    <i class="fas fa-file-excel fa-2x text-success"></i>
                                                    @break
                                                @default
                                                    <i class="fas fa-file fa-2x text-muted"></i>
                                            @endswitch
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $document->title }}</div>
                                            <small class="text-muted">Uploaded on: {{ $document->created_at->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">{{ strtoupper($document->file_type) }}</span></td>
                                <td class="text-center">{{ number_format($document->file_size, 1) }} KB</td>
                                <td class="text-center">{{ $document->download_count }}</td>
                                <td class="text-center">
                                    <a href="{{ route('dokumen.show', $document) }}" target="_blank" class="btn btn-sm btn-outline-info" title="View Document">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('documents.edit', $document) }}" class="btn btn-sm btn-outline-primary" title="Edit Document">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Document">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">
                                    <p class="mb-0 text-muted">Tidak ada dokumen yang ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $documents->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
