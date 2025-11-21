<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0">
            {{ __('Pengaturan Visi & Misi') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.visimisi.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header">
                <h5 class="mb-0">Visi</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="visi" class="form-label">Teks Visi</label>
                    <textarea class="form-control @error('visi') is-invalid @enderror" id="visi" name="visi" rows="5">{{ old('visi', $data->visi) }}</textarea>
                    @error('visi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header">
                <h5 class="mb-0">Misi</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="misi_input" class="form-label">Poin-Poin Misi</label>
                    
                    {{-- 
                      Kita pakai implode() untuk mengubah array jadi teks lagi
                      dengan pemisah baris baru "\n" agar rapi di textarea 
                    --}}
                    <textarea class="form-control @error('misi_input') is-invalid @enderror" 
                              id="misi_input" 
                              name="misi_input" 
                              rows="8">{{ old('misi_input', implode("\n", $data->misi ?? [])) }}</textarea>
                              
                    <div class="form-text">Masukkan satu poin misi per baris (tekan Enter). Urutan akan sesuai dengan yang Anda tulis di sini.</div>
                    @error('misi_input') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
    </form>
</x-app-layout>