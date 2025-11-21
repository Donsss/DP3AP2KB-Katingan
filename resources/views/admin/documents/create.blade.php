<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Add New Document') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="form-label">Document Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="e.g., Laporan Bulanan Januari">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label for="file" class="form-label">Upload File</label>
                    <input type="file" class="form-control" id="file" name="file" required>
                    @error('file') 
                        <div class="text-danger small mt-2">{{ $message }}</div> 
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('documents.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Upload Document</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputElement = document.querySelector('input[id="file"]');
            const titleInput = document.getElementById('title');
            
            const pond = FilePond.create(inputElement, {
                storeAsFile: true,
                labelIdle: `Seret & lepas file PDF Anda atau <span class="filepond--label-action">Telusuri</span>`,
                
                maxFileSize: '2MB',
                acceptedFileTypes: ['application/pdf'],

                labelMaxFileSizeExceeded: 'File terlalu besar',
                labelMaxFileSize: 'Ukuran file maksimum adalah 2MB',
                labelFileTypeNotAllowed: 'Jenis file tidak valid',
                fileValidateTypeLabelExpectedTypes: 'Hanya menerima file .pdf',

                onaddfile: (error, file) => {
                    if (error) {
                        return;
                    }
                    if (titleInput.value === '') {
                        const fileName = file.filename;
                        const title = fileName.substring(0, fileName.lastIndexOf('.'));
                        titleInput.value = title;
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>