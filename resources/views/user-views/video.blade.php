<x-user-components.layout>
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h2 class="fw-bolder border-bottom pb-3">Galeri Video</h2>
            </div>

            <div class="row g-4">
                @forelse($videos as $video)
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="{{ $video->youtube_url }}" class="video-gallery-lightbox d-block mb-2">
                            <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="img-fluid video-thumbnail">
                        </a>
                        <h6 class="video-title-simple">{{ $video->title }}</h6>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada video yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $videos->links() }}
            </div>

        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap');

        body, h2, h6 { font-family: 'Arimo', sans-serif; }
        .video-thumbnail {
            border-radius: 0.375rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            width: 100%;
            aspect-ratio: 16 / 9;
            object-fit: cover;
        }
        .video-thumbnail:hover { box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); }
        .video-title-simple { 
            font-size: 0.9rem; 
            font-weight: 400; 
            color: #333; 
            margin-top: 0.5rem; 
        }
    </style>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videoLightbox = GLightbox({
                selector: '.video-gallery-lightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true,
                title: false, 
                description: false,
            });
        });
    </script>
    @endpush
</x-user-components.layout>