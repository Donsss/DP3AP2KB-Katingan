@props(['latestPhotos', 'latestVideos'])

<section class="py-5" style="background-color: white;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">Galeri Foto</h2>
                    <a href="{{ route('foto') }}" class="btn btn-outline-dark btn-sm">Lihat Semua</a>
                </div>
                <div class="row g-3">
                    @forelse ($latestPhotos as $photo)
                        <div class="col-6">
                            <a href="{{ asset('storage/' . $photo->image) }}" class="gallery-item home-gallery-lightbox" data-gallery="photo-gallery">
                                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="img-fluid">
                                <div class="gallery-overlay">
                                    <i class="fas fa-search-plus fa-2x"></i>
                                    <h5 class="mt-2">{{ $photo->title }}</h5>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted text-center">Belum ada foto terbaru.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">Galeri Video</h2>
                    <a href="{{ route('video') }}" class="btn btn-outline-dark btn-sm">Lihat Semua</a>
                </div>
                <div class="row g-3">
                    @forelse ($latestVideos as $video)
                        <div class="col-6">
                            <a href="{{ $video->youtube_url }}" class="gallery-item home-video-lightbox" data-gallery="video-gallery">
                                <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="img-fluid">
                                <div class="gallery-overlay">
                                    <i class="fas fa-play-circle fa-2x"></i>
                                    <h5 class="mt-2">{{ $video->title }}</h5>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted text-center">Belum ada video terbaru.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .gallery-item {
        position: relative;
        display: block;
        overflow: hidden;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .gallery-item .img-fluid {
        transition: transform 0.4s ease;
        aspect-ratio: 16 / 9; 
        object-fit: cover;
        width: 100%;
    }
    .gallery-item:hover .img-fluid {
        transform: scale(1.05);
    }
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        opacity: 0;
        transition: opacity 0.4s ease;
        padding: 1rem;
    }
    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }
    .gallery-overlay h5 {
        font-weight: 600;
        margin-bottom: 0;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
    }
</style>


@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const photoLightbox = GLightbox({
            selector: '.home-gallery-lightbox',
            touchNavigation: true,
            loop: true,
            gallery: 'home-photo-gallery',
        });

        const videoLightbox = GLightbox({
            selector: '.home-video-lightbox',
            autoplayVideos: true,
            touchNavigation: true,
            loop: true,
            gallery: 'home-video-gallery',
        });
    });
</script>
@endpush
