<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="h4 font-weight-bold mb-0">{{ __('Semua Berita') }}</h2>
            
            <div class="d-flex gap-2 align-items-center">
                <form action="{{ route('posts.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari judul..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-danger" title="Reset">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>

                <a href="{{ route('posts.create') }}" class="btn btn-primary text-nowrap">
                    <i class="fas fa-plus me-2"></i> Buat Berita Baru
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

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Berita</th>
                            <th>Author</th>
                            <th class="text-center">Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="rounded me-3" style="width: 80px; height: 50px; object-fit: cover;">
                                        <div>
                                            <a href="{{ route('posts.show', $post) }}" class="fw-bold text-dark text-decoration-none">{{ Str::limit($post->title, 45) }}</a>
                                            <div class="text-muted small">
                                                Published: {{ $post->published_at ? $post->published_at->format('d M Y') : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $post->author->name }}</td>
                                <td class="text-center">
                                    @if($post->status == 'published')
                                        <span class="badge bg-success-subtle text-success-emphasis rounded-pill">Published</span>
                                    @elseif($post->status == 'draft')
                                        <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill">Draft</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">Private</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-info" title="Preview"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-5">
                                    @if(request('search'))
                                        <h5 class="mb-2">Tidak ditemukan</h5>
                                        <p class="text-muted">Tidak ada berita yang cocok dengan kata kunci "{{ request('search') }}".</p>
                                        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm mt-2">Reset Pencarian</a>
                                    @else
                                        <h5 class="mb-2">Belum Ada Berita</h5>
                                        <p class="text-muted">Mulai dengan membuat berita pertama Anda.</p>
                                        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm mt-2"><i class="fas fa-plus me-2"></i> Buat Berita Baru</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $posts->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>