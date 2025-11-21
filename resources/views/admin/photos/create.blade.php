<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Add New Photo') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <p class="text-muted">Judul foto akan secara otomatis dibuat dari nama berkas. Anda bisa mengunggah banyak foto sekaligus.</p>
            
            <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="images" class="form-label">File Foto (Bisa lebih dari satu)</label>
                    
                    <input type="file" class="form-control" id="images" name="images[]" required multiple>
                
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ route('photos.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Unggah Foto</button>
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
                
                allowMultiple: true,
                allowReorder: true,

                maxFileSize: '2MB', 
                acceptedFileTypes: [
                    'image/jpeg', 
                    'image/png', 
                    'image/gif', 
                    'image/svg+xml',
                    'image/webp' 
                ],

                labelIdle: `Seret & lepas foto Anda atau <span class="filepond--label-action"> Telusuri </span>`,
                labelFileValidateTypeNotAllowed: 'Jenis file tidak valid',
                labelMaxFileSizeExceeded: 'File terlalu besar (Maks 2MB)',
                labelMaxFileSize: 'Ukuran file maksimum adalah {filesize}',
            });
        });
    </script>
    @endpush
</x-app-layout>