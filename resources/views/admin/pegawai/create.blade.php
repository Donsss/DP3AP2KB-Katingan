<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Tambah Pegawai Baru') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    {{-- Kolom Kiri: Info Dasar --}}
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Jabatan</label>
                            <input type="text" name="position" id="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}" required>
                            @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" placeholder="Isi '-' jika tidak ada" required>
                                @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="bidang_id" class="form-label">Bidang</label>
                                <select name="bidang_id" id="bidang_id" class="form-select @error('bidang_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Bidang...</option>
                                    @foreach($bidangs as $bidang)
                                        <option value="{{ $bidang->id }}" @selected(old('bidang_id') == $bidang->id)>{{ $bidang->name }}</option>
                                    @endforeach
                                </select>
                                @error('bidang_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Kepegawaian</label>
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="asn" value="asn" @checked(old('status', 'asn') == 'asn')>
                                    <label class="form-check-label" for="asn">ASN</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="non-asn" value="non-asn" @checked(old('status') == 'non-asn')>
                                    <label class="form-check-label" for="non-asn">Non ASN</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Foto --}}
                    <div class="col-md-4">
                        <label for="photo" class="form-label">Foto Pegawai</label>
                        <input type="file" name="photo" id="photo" required>
                        @error('photo') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 border-top pt-3">
                    <a href="{{ route('admin.pegawai.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Pegawai</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Aktifkan FilePond untuk pratinjau gambar
            FilePond.registerPlugin(FilePondPluginImagePreview);

            const inputElement = document.querySelector('input[id="photo"]');
            const pond = FilePond.create(inputElement, {
                storeAsFile: true,
                labelIdle: `Drag & Drop foto atau <span class="filepond--label-action">Browse</span>`,
                imagePreviewHeight: 200,
                stylePanelLayout: 'integrated',
                imageCropAspectRatio: '4:5', // Rasio aspek potret
            });
        });
    </script>
    @endpush
</x-app-layout>
