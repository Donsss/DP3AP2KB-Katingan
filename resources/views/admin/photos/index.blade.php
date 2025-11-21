<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">{{ __('Gallery Foto') }}</h2>
                <p class="text-muted small mb-0">Klik pada foto untuk melihat pratinjau</p>
            </div>
            <a href="{{ route('photos.create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus me-2"></i> {{ __('Add New Photo') }}
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
        @forelse ($photos as $photo)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="gallery-item">
                        <a href="{{ asset('storage/' . $photo->image) }}" 
                           class="gallery-lightbox" >
                            <img src="{{ asset('storage/' . $photo->image) }}" class="card-img-top" alt="{{ $photo->title }}">
                            <div class="gallery-overlay"><i class="fas fa-search"></i></div>
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <p class="card-text small text-muted flex-grow-1">{{ $photo->title }}</p>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('photos.edit', $photo) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                    <h4 class="font-weight-bold">Tidak Ada Foto Ditemukan</h4>
                    <a href="{{ route('photos.create') }}" class="btn btn-primary mt-2"><i class="fas fa-plus me-2"></i> Add Your First Photo</a>
                </div>
            </div>
        @endforelse
    </div>

    <style>
        .card-img-top { aspect-ratio: 4 / 3; object-fit: cover; }
        .gallery-item { position: relative; overflow: hidden; }
        .gallery-item img { transition: transform 0.4s ease; }
        .gallery-item:hover img { transform: scale(1.1); }
        .gallery-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; opacity: 0; transition: opacity 0.4s ease; }
        .gallery-item:hover .gallery-overlay { opacity: 1; }
        .gallery-overlay i { color: white; font-size: 2rem; }
    </style>

</x-app-layout>