<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Edit Document') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('documents.update', $document) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="form-label">Document Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $document->title) }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label for="file" class="form-label">Replace File (Optional)</label>
                    <input type="file" class="form-control" id="file" name="file">
                    <div class="form-text mt-2">
                        Current file: 
                        <a href="{{ route('dokumen.show', $document) }}" target="_blank">{{ $document->title }}.{{ $document->file_type }}</a>
                    </div>
                    @error('file') 
                        <div class="text-danger small mt-2">{{ $message }}</div> 
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('documents.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Document</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputElement = document.querySelector('input[id="file"]');
            
            const pond = FilePond.create(inputElement, {
                storeAsFile: true,
                
                labelIdle: `Seret & lepas file PDF baru atau <span class="filepond--label-action">Telusuri</span>`,
                maxFileSize: '2MB',
                acceptedFileTypes: ['application/pdf'],

                labelMaxFileSizeExceeded: 'File terlalu besar',
                labelMaxFileSize: 'Ukuran file maksimum adalah 2MB',
                labelFileTypeNotAllowed: 'Jenis file tidak valid',
                fileValidateTypeLabelExpectedTypes: 'Hanya menerima file .pdf',

                pdfWorker: 'https://unpkg.com/pdfjs-dist@3.11.174/build/pdf.worker.min.js'
            });
        });
    </script>
    @endpush
</x-app-layout>
