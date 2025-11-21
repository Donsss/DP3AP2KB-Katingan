<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Video Gallery') }}</h2>
                <p class="text-muted small mb-0">Klik video untuk melihat pratinjau.</p>
            </div>
            <a href="{{ route('videos.create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus me-2"></i> {{ __('Add New Video') }}
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse ($videos as $video)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 video-card">
                    <a href="{{ $video->youtube_url }}" class="video-gallery-lightbox video-thumbnail-wrapper">
                        <img src="{{ $video->thumbnail }}" class="video-thumbnail" alt="{{ $video->title }}">
                        <div class="video-overlay">
                            <i class="fab fa-youtube fa-3x text-white"></i>
                        </div>
                    </a>
                    <div class="card-body d-flex flex-column">
                        <p class="card-text small text-muted flex-grow-1">{{ $video->title }}</p>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('videos.edit', $video) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center p-5 bg-light rounded">
                    <h4 class="font-weight-bold">No Videos Found</h4>
                    <a href="{{ route('videos.create') }}" class="btn btn-primary mt-2"><i class="fas fa-plus me-2"></i> Add Your First Video</a>
                </div>
            </div>
        @endforelse
    </div>

    <style>
        .video-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; 
        }
        .video-thumbnail-wrapper {
            display: block;
            position: relative;
            overflow: hidden;
            border-top-left-radius: var(--bs-card-border-radius);
            border-top-right-radius: var(--bs-card-border-radius);
        }
        .video-thumbnail { 
            width: 100%;
            aspect-ratio: 16 / 9; 
            object-fit: cover; 
            transition: transform 0.3s ease;
        }
        .video-thumbnail-wrapper:hover .video-thumbnail {
            transform: scale(1.1);
        }
        .video-overlay {
            position: absolute; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
            display: flex; /* Kunci untuk pemusatan */
            justify-content: center; /* Kunci untuk pemusatan */
            align-items: center; /* Kunci untuk pemusatan */
            opacity: 0; 
            transition: opacity 0.3s ease;
        }
        .video-thumbnail-wrapper:hover .video-overlay { 
            opacity: 1; 
        }
    </style>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videoLightbox = GLightbox({
                selector: '.video-gallery-lightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true
            });
        });
    </script>
    @endpush
</x-app-layout>

