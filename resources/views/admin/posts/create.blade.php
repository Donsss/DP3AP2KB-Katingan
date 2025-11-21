<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Create New Post') }}</h2>
    </x-slot>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="myeditorinstance" class="form-label">Content</label>
                            <textarea id="myeditorinstance" name="body">{{ old('body') }}</textarea>
                            @error('body') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Samping (Metadata) --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header"><strong>Publish</strong></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="draft" @selected(old('status') == 'draft')>Draft</option>
                                <option value="published" @selected(old('status') == 'published')>Published</option>
                                <option value="private" @selected(old('status') == 'private')>Private</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Post</button>
                        </div>
                    </div>
                </div>

                {{-- Featured Image sekarang di posisi kedua --}}
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header"><strong>Featured Image</strong></div>
                    <div class="card-body">
                        <input type="file" name="image" id="image" required>
                        @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <x-text-editor></x-text-editor>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. JANGAN panggil FilePond.registerPlugin() lagi
            
            const inputElement = document.querySelector('input[id="image"]');
            
            const pond = FilePond.create(inputElement, {
                storeAsFile: true,
                stylePanelLayout: 'integrated', // Ini sudah benar
                imagePreviewHeight: 170,
                
                // 2. TAMBAHKAN VALIDASI KONSISTEN
                // (Sesuaikan dengan controller Anda!)
                maxFileSize: '2MB', 
                acceptedFileTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'],

                // 3. Tambahkan label yang SAMA juga
                labelIdle: `Seret & lepas gambar Anda atau <span class="filepond--label-action"> Telusuri </span>`,
                labelFileValidateTypeNotAllowed: 'Jenis file tidak valid (Hanya .jpg, .png, .webp)',
                labelMaxFileSizeExceeded: 'File terlalu besar (Maks 2MB)',
                labelMaxFileSize: 'Ukuran file maksimum adalah {filesize}',
                
                // 4. HAPUS imageCropAspectRatio untuk sekarang,
                //    karena plugin-nya belum diinstal.
            });
        });
    </script>
    @endpush
</x-app-layout>

