<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Post Preview') }}</h2>
                <a href="{{ route('posts.index') }}">&larr; Back to all posts</a>
            </div>
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary"><i class="fas fa-edit me-2"></i> Edit Post</a>
        </div>
    </x-slot>

    <div class="card shadow-sm border-0">
        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="max-height: 400px; object-fit: cover;">
        <div class="card-body p-4 p-md-5">
            <h1 class="card-title fw-bolder">{{ $post->title }}</h1>
            <div class="d-flex align-items-center text-muted mb-4 small">
                <span>By {{ $post->author->name }}</span>
                <span class="mx-2">&bull;</span>
                <span>{{ $post->created_at->format('d F Y') }}</span>
                <span class="mx-2">&bull;</span>
                <span class="badge 
                    @if($post->status == 'published') bg-success 
                    @elseif($post->status == 'draft') bg-warning text-dark
                    @else bg-secondary @endif">
                    {{ ucfirst($post->status) }}
                </span>
            </div>
            
            <div class="post-content">
                {!! $post->body !!}
            </div>
        </div>
    </div>

    <style>
        .post-content img { max-width: 100%; height: auto; border-radius: 0.5rem; }
        .post-content h1, .post-content h2, .post-content h3 { margin-top: 1.5rem; margin-bottom: 1rem; font-weight: 600; }
        .post-content p { line-height: 1.8; }
    </style>
</x-app-layout>
