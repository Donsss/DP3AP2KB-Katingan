<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Edit Slider') }}
        </h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Slider (Kosongkan untuk tetap terkini)</label>
                            
                            <input type="file" class="form-control" id="image" name="image" data-file-poster="{{ asset('storage/' . $slider->image) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul (Opsional)</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $slider->title) }}">
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ $slider->status ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Aktif</label>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ route('sliders.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Slider</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const inputElement = document.querySelector('input[type="file"]');

            const pond = FilePond.create(inputElement, {
                storeAsFile: true,
                stylePanelLayout: 'compact',
                
                maxFileSize: '2MB', 
                acceptedFileTypes: [
                    'image/jpeg', 
                    'image/png', 
                    'image/gif', 
                    'image/svg+xml' 
                ],

                labelIdle: `Seret & lepas gambar baru atau <span class="filepond--label-action"> Telusuri </span>`,
                labelFileValidateTypeNotAllowed: 'Jenis file tidak valid (Hanya .jpg, .png, .gif, .svg)',
                labelMaxFileSize: 'Ukuran file maksimum adalah 2MB',
            });
        });
    </script>
    @endpush
</x-app-layout>

