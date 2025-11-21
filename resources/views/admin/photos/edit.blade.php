<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Edit Photo') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('photos.update', $photo) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="image" class="form-label">Replace Photo (Optional)</label>
                            <input type="file" name="image" data-file-poster="{{ asset('storage/' . $photo->image) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $photo->title) }}" required>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ route('photos.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Photo</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputElement = document.querySelector('input[type="file"]');
            
            FilePond.create(inputElement, {
                storeAsFile: true,
                stylePanelLayout: 'compact', 

                maxFileSize: '2MB', 
                acceptedFileTypes: [
                    'image/jpeg', 
                    'image/png', 
                    'image/gif',
                    'image/jpg'
                ],

                labelIdle: `Seret & lepas gambar baru atau <span class="filepond--label-action"> Telusuri </span>`,
                labelFileValidateTypeNotAllowed: 'Jenis file tidak valid',
                labelMaxFileSizeExceeded: 'File terlalu besar (Maks 2MB)',
                labelMaxFileSize: 'Ukuran file maksimum adalah {filesize}',
            });
        });
    </script>
    @endpush
</x-app-layout>
