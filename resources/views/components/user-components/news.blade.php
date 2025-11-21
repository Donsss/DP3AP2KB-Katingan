@props(['latestPosts', 'popularPosts'])

@php
    $mainPopularPost = $popularPosts->shift();
@endphp

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">Berita Terbaru</h2>
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-dark btn-sm">Lihat Semua Berita &rarr;</a>
                </div>
                <div class="row g-4">
                    @forelse ($latestPosts as $post)
                        <div class="col-md-6">
                            <a href="{{ route('berita.show', $post->slug) }}" class="text-decoration-none">
                                <div class="card press-release-card h-100 shadow-sm">
                                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                                    
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title press-release-title mb-2">{{ $post->title }}</h5>
                                        <p class="card-text text-muted small mb-1">{{ $post->published_at->format('d F Y') }}</p>
                                        <p class="card-text press-release-summary">{{ $post->excerpt }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted">Belum ada berita terbaru.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="col-lg-5">
                <h2 class="fw-bold mb-4">Berita Populer</h2>
                <div class="latest-news-wrapper">
                    @if ($mainPopularPost)
                        <a href="{{ route('berita.show', $mainPopularPost->slug) }}" class="text-decoration-none">
                            <div class="main-latest-news mb-4">
                                <img src="{{ asset('storage/' . $mainPopularPost->image) }}" class="img-fluid" alt="{{ $mainPopularPost->title }}">
                                <div class="main-latest-news-title">
                                    <h4 class="text-white">{{ $mainPopularPost->title }}</h4>
                                </div>
                            </div>
                        </a>
                    @endif
                    
                    <div class="list-group list-group-flush">
                        @forelse ($popularPosts as $post)
                            <a href="{{ route('berita.show', $post->slug) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <div class="list-img-wrapper me-3 rounded">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $post->title }}</h6>
                                    <small class="text-muted">{{ $post->published_at->format('d F Y') }}</small>
                                </div>
                            </a>
                        @empty
                             @if (!$mainPopularPost)
                                <p class="text-muted">Belum ada berita populer.</p>
                            @endif
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .press-release-card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .press-release-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .press-release-card .card-img-top {
        border-radius: 0.375rem 0.375rem 0 0;
        object-fit: cover;
        height: 200px;
    }
    .press-release-title {
        color: #212529;
        font-weight: 600;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
    .press-release-summary {
        font-size: 0.9rem;
        color: #6c757d;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
        overflow: hidden;
        margin-top: 0.5rem;
    }

    .main-latest-news {
        position: relative;
        overflow: hidden;
        border-radius: 0.375rem;
    }
    .main-latest-news img {
        transition: transform 0.4s ease;
        width: 100%;
        aspect-ratio: 16/10;
        object-fit: cover;
    }
    .main-latest-news:hover img {
        transform: scale(1.05);
    }
    .main-latest-news-title {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); /* Gradasi Hitam Kembali */
        text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
    }

    .list-group-item {
        padding: 1rem 0;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .list-group-item:last-child {
        border-bottom: none !important;
    }
    
    .list-img-wrapper {
        width: 80px;
        height: 80px;
        min-width: 80px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem !important;
    }
    
    .list-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>