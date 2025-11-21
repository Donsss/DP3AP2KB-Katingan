<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('Tambah Bidang Baru') }}</h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('bidangs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Bidang</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @else
                        <div class="form-text">Slug akan dibuat secara otomatis.</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('bidangs.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Bidang</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
