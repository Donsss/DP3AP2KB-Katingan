<x-user-components.layout>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4 align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bolder">Berita Terkini</h2>
                    <p class="text-muted mb-0">Ikuti perkembangan dan informasi terbaru dari kami.</p>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('berita.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari berita..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if($featuredPost)
                <div class="card shadow-sm mb-5 border-0">
                    <div class="row g-0">
                        <div class="col-lg-7">
                            <img src="{{ asset('storage/' . $featuredPost->image) }}" class="img-fluid rounded-start" alt="{{ $featuredPost->title }}" style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                        <div class="col-lg-5 d-flex flex-column p-4">
                            <div class="card-body">
                                <div class="mb-2">
                                    <small class="text-muted ms-2">{{ $featuredPost->published_at->format('d F Y') }}</small>
                                </div>
                                <h3 class="card-title fw-bold">
                                    <a href="{{ route('berita.show', $featuredPost->slug) }}" class="text-decoration-none text-dark stretched-link">
                                        {{ $featuredPost->title }}
                                    </a>
                                </h3>
                                <p class="card-text text-muted mt-3 d-none d-lg-block">{{ $featuredPost->excerpt }}</p>
                            </div>
                            <div class="mt-auto pt-3">
                                <div class="d-flex align-items-center">
                                    <img src="https://placehold.co/40x40/ced4da/6c757d?text={{ substr($featuredPost->author->name, 0, 1) }}" class="rounded-circle me-2" alt="Author">
                                    <small class="text-muted">Oleh {{ $featuredPost->author->name }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row g-4">
                @forelse ($posts as $post)
                    <div class="col-md-6 col-lg-4">
                        <div class="news-item">
                            <a href="{{ route('berita.show', $post->slug) }}" class="news-item-img-link">
                                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid news-item-img" alt="{{ $post->title }}">
                            </a>
                            <div class="news-item-body">
                                <h5 class="news-item-title">
                                    <a href="{{ route('berita.show', $post->slug) }}" class="text-decoration-none stretched-link">{{ $post->title }}</a>
                                </h5>
                                <p class="news-item-summary">{{ $post->excerpt }}</p>
                                <small class="news-item-date text-muted">{{ $post->published_at->format('l, d F Y') }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                         <h4 class="text-muted">Tidak ada berita yang ditemukan.</h4>
                    </div>
                @endforelse
            </div>

            <div class="mt-5">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

    <style>
        .card .stretched-link:hover {
            color: #0d6efd !important;
        }
        .card-title a {
            transition: color 0.3s ease;
        }

        .news-item {
            position: relative;
        }
        .news-item-img {
            border-radius: 0.5rem;
            aspect-ratio: 16 / 10;
            object-fit: cover;
            margin-bottom: 1rem;
            transition: opacity 0.3s ease;
        }
        .news-item:hover .news-item-img {
            opacity: 0.85;
        }
        .news-item-body {
            padding: 0;
        }
        .news-item-meta {
            margin-bottom: 0.5rem;
        }
        .news-item-title {
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }
        .news-item-title a {
            color: #212529;
        }
        .news-item-summary {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.75rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
        .news-item-date {
            font-size: 0.8rem;
        }

        .category-link {
            position: relative;
            z-index: 2;
        }

        .bg-purple { background-color: #6f42c1 !important; }
        .bg-orange { background-color: #fd7e14 !important; }
        .bg-teal { background-color: #20c997 !important; }
        .bg-pink { background-color: #d63384 !important; }

        .page-link:hover {
            color: #0d6efd;
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>
</x-user-components.layout>

