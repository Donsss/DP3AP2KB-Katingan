<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0">
            {{ __('Tambah Riwayat Pekerjaan') }}
        </h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.pekerjaan.store') }}" method="POST">
                @csrf
                
                {{-- Memanggil form partial --}}
                @include('admin.pekerjaan.partials.form-fields')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan</button>
                    <a href="{{ route('admin.pekerjaan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>