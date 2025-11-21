<x-user-components.layout>
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h2 class="fw-bolder border-bottom pb-3">UNDUH FILE</h2>
            </div>

            <div class="table-responsive shadow-sm rounded">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="d-none d-md-table-cell text-center" style="width: 5%;">No</th>
                            
                            <th scope="col">Nama File</th>
                            
                            <th scope="col" class="d-none d-md-table-cell text-center" style="width: 15%;">Jumlah Unduh</th>
                            
                            <th scope="col" class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($documents as $document)
                            <tr>
                                <th scope="row" class="text-center d-none d-md-table-cell">
                                    {{ $loop->iteration + ($documents->currentPage() - 1) * $documents->perPage() }}
                                </th>
                                
                                <td>
                                    <span class="fw-medium">{{ $document->title }}</span>
                                    
                                    <div class="d-md-none text-muted small mt-1">
                                        <i class="fas fa-download me-1"></i> {{ $document->download_count }}x diunduh
                                    </div>
                                </td>

                                <td class="text-center d-none d-md-table-cell">
                                    {{ $document->download_count }}
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('dokumen.show', $document) }}" target="_blank" 
                                           class="btn btn-info btn-sm text-white" 
                                           title="Lihat Dokumen">
                                            <i class="fas fa-eye"></i> 
                                            <span class="d-none d-md-inline ms-1">Lihat</span>
                                        </a>

                                        <a href="{{ route('dokumen.download', $document) }}" 
                                           class="btn btn-success btn-sm" 
                                           title="Unduh File">
                                            <i class="fas fa-download"></i>
                                            <span class="d-none d-md-inline ms-1">Unduh</span>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Belum ada dokumen yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <nav class="mt-4 d-flex justify-content-center">
                {{ $documents->links() }}
            </nav>
            
        </div>
    </section>
</x-user-components.layout>

<style>
    .table thead th {
        font-weight: 600;
        color: #495057;
        background-color: #f8f9fa;
        white-space: nowrap;
    }
    
    .table td, .table th {
        padding: 0.75rem 0.5rem;
    }

    @media (max-width: 768px) {
        .table td span.fw-medium {
            font-size: 0.95rem; 
        }
        
        .btn-sm {
            padding: 0.4rem 0.6rem;
            font-size: 0.9rem;
        }
    }
</style>