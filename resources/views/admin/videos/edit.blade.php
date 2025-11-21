<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Edit Video') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('videos.update', $video) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="youtube_url" class="form-label">URL YouTube</label>
                    <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $video->youtube_url) }}" required placeholder="Misal, https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                    @error('youtube_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Tempelkan URL video YouTube yang valid.</div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul (Opsional)</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $video->title) }}" placeholder="Biarkan kosong untuk menggunakan judul video YouTube">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Preview Area --}}
                <div id="video-preview-area" class="mb-3">
                    <h6>Current Video Preview:</h6>
                    <img id="thumbnail-preview" src="{{ old('thumbnail', $video->thumbnail) }}" alt="Video Thumbnail" class="img-fluid rounded mb-2" style="max-width: 320px;">
                    <p id="title-preview" class="text-muted small">{{ old('title', $video->title) }}</p>
                </div>
                
                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ route('videos.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Perbarui Video</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const youtubeUrlInput = document.getElementById('youtube_url');
            const titleInput = document.getElementById('title');
            const videoPreviewArea = document.getElementById('video-preview-area');
            const thumbnailPreview = document.getElementById('thumbnail-preview');
            const titlePreview = document.getElementById('title-preview');
            let typingTimer;
            const doneTypingInterval = 1000; // 1 second

            async function fetchVideoData(url) {
                try {
                    const response = await fetch('{{ route("videos.fetchYoutubeInfo") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ youtube_url: url })
                    });
                    const data = await response.json();
                    if (response.ok) {
                        return data;
                    } else {
                        throw new Error(data.error || 'Failed to fetch video info.');
                    }
                } catch (error) {
                    console.error('Error fetching YouTube info:', error);
                    return null;
                }
            }

            async function updatePreview() {
                const url = youtubeUrlInput.value;
                if (!url) {
                    // Hide preview if URL is empty, or show current video's info if in edit mode
                    videoPreviewArea.style.display = 'block'; // Keep it visible in edit mode
                    thumbnailPreview.src = '{{ old('thumbnail', $video->thumbnail) }}';
                    titlePreview.textContent = '{{ old('title', $video->title) }}';
                    return;
                }

                const videoData = await fetchVideoData(url);

                if (videoData) {
                    thumbnailPreview.src = videoData.thumbnail;
                    titlePreview.textContent = videoData.title;
                    videoPreviewArea.style.display = 'block';

                    // Hanya isi judul jika input judul kosong
                    if (!titleInput.value || titleInput.value === '{{ $video->title }}') { // Cek juga judul asli
                        titleInput.value = videoData.title;
                    }
                } else {
                    // Jika URL tidak valid, kembali ke preview video yang sudah ada
                    thumbnailPreview.src = '{{ old('thumbnail', $video->thumbnail) }}';
                    titlePreview.textContent = '{{ old('title', $video->title) }}';
                    // Opsional: tampilkan pesan error di UI
                }
            }

            youtubeUrlInput.addEventListener('keyup', () => {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(updatePreview, doneTypingInterval);
            });
            youtubeUrlInput.addEventListener('change', updatePreview);
            
            // Initial preview on page load if an existing video
            updatePreview(); 
        });
    </script>
    @endpush
</x-app-layout>