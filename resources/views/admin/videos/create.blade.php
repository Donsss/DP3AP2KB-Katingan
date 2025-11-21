<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Add New Video') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('videos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="youtube_url" class="form-label">URL YouTube</label>
                    <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url" name="youtube_url" value="{{ old('youtube_url') }}" required placeholder="Misal, https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                    @error('youtube_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Tempelkan URL video YouTube yang valid.</div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul (Opsional)</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Biarkan kosong untuk menggunakan judul video YouTube">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div id="video-preview-area" class="mb-3" style="display: {{ old('youtube_id') ? 'block' : 'none' }};">
                    <h6>Preview:</h6>
                    <img id="thumbnail-preview" src="{{ old('thumbnail') }}" alt="Video Thumbnail" class="img-fluid rounded mb-2" style="max-width: 320px;">
                    <p id="title-preview" class="text-muted small">{{ old('title') ?? old('youtube_title_from_api') }}</p>
                </div>
                
                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ route('videos.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add Video</button>
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

            // Function to fetch video info
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

            // Update preview and optional title field
            async function updatePreview() {
                const url = youtubeUrlInput.value;
                if (!url) {
                    videoPreviewArea.style.display = 'none';
                    return;
                }

                const videoData = await fetchVideoData(url);

                if (videoData) {
                    thumbnailPreview.src = videoData.thumbnail;
                    titlePreview.textContent = videoData.title;
                    videoPreviewArea.style.display = 'block';

                    // Hanya isi judul jika input judul kosong
                    if (!titleInput.value) {
                        titleInput.value = videoData.title;
                    }
                } else {
                    videoPreviewArea.style.display = 'none';
                    titleInput.value = ''; // Clear title if URL is invalid
                    // Opsional: tampilkan pesan error di UI
                }
            }

            // Event listener for input change (with debounce)
            youtubeUrlInput.addEventListener('keyup', () => {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(updatePreview, doneTypingInterval);
            });

            youtubeUrlInput.addEventListener('change', updatePreview); // For immediate update on paste

            // Initial preview on page load if old input exists
            if (youtubeUrlInput.value) {
                updatePreview();
            }
        });
    </script>
    @endpush
</x-app-layout>