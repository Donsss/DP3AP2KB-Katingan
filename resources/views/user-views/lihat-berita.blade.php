@push('meta')
    @php
        $cleanDescription = \Illuminate\Support\Str::limit(strip_tags($post->body), 150);
        
        $postImage = $post->image ? asset('storage/' . $post->image) : asset('images/katingan-logo.png');
    @endphp

    <meta name="description" content="{{ $cleanDescription }}">
    <meta name="author" content="{{ $post->author->name }}">
    <meta name="keywords" content="berita, dp3a, {{ $post->title }}">

    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="DP3AP2KB" />
    <meta property="og:title" content="{{ $post->title }}" />
    <meta property="og:description" content="{{ $cleanDescription }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ $postImage }}" />
    
    <meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}" />
    <meta property="article:author" content="{{ $post->author->name }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $post->title }}" />
    <meta name="twitter:description" content="{{ $cleanDescription }}" />
    <meta name="twitter:image" content="{{ $postImage }}" />
@endpush

<x-user-components.layout :title="$post->title">
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <article>
                        <header class="mb-4">
                            <h1 class="fw-bolder mb-3">{{ $post->title }}</h1>
                            <div class="d-flex flex-wrap align-items-center text-muted fst-italic mb-3">
                                <span>{{ $post->published_at->isoFormat('dddd, D MMMM YYYY • HH.mm') }}</span>
                                <span class="mx-2">&bull;</span>
                                <span>Oleh: {{ $post->author->name }}</span>
                                <span class="mx-2">&bull;</span>
                                <span>{{ $post->view_count }}x dilihat</span>
                            </div>

                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3">Bagikan:</span>
                                <div class="share-buttons">
                                    <a href="#" id="share-facebook" class="share-btn" title="Bagikan ke Facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" id="share-twitter" class="share-btn" title="Bagikan ke Twitter"><i class="bi bi-twitter-x"></i></a>
                                    <a href="#" id="share-whatsapp" class="share-btn" title="Bagikan ke WhatsApp"><i class="bi bi-whatsapp"></i></a>
                                    <a href="#" id="share-telegram" class="share-btn" title="Bagikan ke Telegram"><i class="bi bi-telegram"></i></a>
                                    <button id="copy-link-btn" class="share-btn" title="Salin Tautan">
                                        <i class="bi bi-link-45deg"></i>
                                    </button>
                                    <span id="copy-status" class="copy-status-text ms-2"></span>
                                </div>
                            </div>
                        </header>

                        <figure class="mb-4">
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $post->title }}">
                        </figure>

                        <section class="fs-5 post-content">
                            {!! $post->body !!}
                        </section>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <style>
        .post-content p { line-height: 1.8; }
        .post-content img { max-width: 100%; height: auto; border-radius: 0.5rem; margin-top: 1rem; margin-bottom: 1rem; }
        .post-content h1, .post-content h2, .post-content h3 { margin-top: 1.5rem; margin-bottom: 1rem; font-weight: 600; }
        
        .share-buttons .share-btn {
            display: inline-flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; border-radius: 50%;
            background-color: #f0f2f5; color: #4b4f56;
            text-decoration: none; margin-right: 8px;
            transition: all 0.3s ease; font-size: 1.2rem; border: none;
        }
        .share-buttons .share-btn:hover { background-color: #e2e6ea; transform: translateY(-2px); }
        .copy-status-text { font-size: 0.9rem; color: #198754; font-weight: 500; }
    </style>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const postUrl = encodeURIComponent(window.location.href);
            const postTitle = encodeURIComponent("{{ $post->title }}");

            document.getElementById('share-facebook').href = `https://www.facebook.com/sharer/sharer.php?u=${postUrl}`;
            document.getElementById('share-twitter').href = `https://twitter.com/intent/tweet?url=${postUrl}&text=${postTitle}`;
            document.getElementById('share-whatsapp').href = `https://api.whatsapp.com/send?text=${postTitle} ${postUrl}`;
            document.getElementById('share-telegram').href = `https://t.me/share/url?url=${postUrl}&text=${postTitle}`;

            const copyLinkBtn = document.getElementById('copy-link-btn');
            const copyStatus = document.getElementById('copy-status');

            copyLinkBtn.addEventListener('click', () => {
                navigator.clipboard.writeText(decodeURIComponent(postUrl)).then(() => {
                    copyStatus.textContent = 'Tautan disalin!';
                    setTimeout(() => { copyStatus.textContent = ''; }, 2000);
                }).catch(err => {
                    console.error('Gagal menyalin tautan: ', err);
                    copyStatus.textContent = 'Gagal';
                    setTimeout(() => { copyStatus.textContent = ''; }, 2000);
                });
            });
        });
    </script>
    @endpush
</x-user-components.layout>