<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Edit Tautan Cepat') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('quick-links.update', $quickLink) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Tautan</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $quickLink->title) }}" required>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL (Link)</label>
                    <input type="url" class="form-control" id="url" name="url" value="{{ old('url', $quickLink->url) }}" required>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ route('quick-links.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update Tautan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>