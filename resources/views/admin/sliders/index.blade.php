<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 font-weight-bold mb-0">
                    {{ __('Image Sliders') }}
                </h2>
                <p class="text-muted small mb-0">Drag and drop cards to re-order the sliders.</p>
            </div>

            <a href="{{ route('sliders.create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus me-2"></i> {{ __('Add New Slider') }}
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row" id="slider-list">
        @forelse ($sliders as $slider)
            <div class="col-12 col-md-6 col-lg-4 mb-4" data-id="{{ $slider->id }}">
                <div class="card h-100 shadow-sm border-0 slider-card">
                    <img src="{{ asset('storage/' . $slider->image) }}" class="card-img-top" alt="{{ $slider->title ?? 'Slider Image' }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $slider->title ?? 'No Title' }}</h5>
                        <div>
                            @if ($slider->status)
                                <span class="badge bg-success-subtle text-success-emphasis rounded-pill">
                                    <i class="fas fa-check-circle me-1"></i> Aktif
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">
                                    <i class="fas fa-times-circle me-1"></i> Tidak Aktif
                                </span>
                            @endif
                        </div>

                        <div class="mt-auto pt-3 d-flex justify-content-between align-items-center">
                            <i class="fas fa-arrows-alt text-muted drag-handle" style="cursor: grab;"></i>

                            <div class="d-flex gap-2">
                                <a href="{{ route('sliders.edit', $slider) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('sliders.destroy', $slider) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center p-5 bg-light rounded">
                    <i class="fas fa-photo-video fa-3x text-muted mb-3"></i>
                    <h4 class="font-weight-bold">Tidak Ada Slider yang Ditemukan</h4>
                    <p class="text-muted">Mulai dengan menambahkan slider baru.</p>
                    <a href="{{ route('sliders.create') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-plus me-2"></i> Tambahkan Slider Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sliderList = document.getElementById('slider-list');
            if (sliderList) {
                new Sortable(sliderList, {
                    animation: 150,
                    handle: '.drag-handle',
                    onEnd: function (evt) {
                        const items = sliderList.querySelectorAll('[data-id]');
                        const order = Array.from(items).map(item => item.dataset.id);

                        fetch('{{ route("sliders.updateOrder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ order: order })
                        })
                        .then(response => response.json())
                        .then(data => console.log(data.message))
                        .catch(error => console.error('Error:', error));
                    }
                });
            }
        });
    </script>
    @endpush

    <style>
        .slider-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .slider-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
        .card-img-top {
            aspect-ratio: 16 / 9;
            object-fit: cover;
        }
        .drag-handle:hover {
            color: #0d6efd !important;
        }
    </style>
</x-app-layout>

