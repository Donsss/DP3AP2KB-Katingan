<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0">{{ __('Edit Anggota: ') }} {{ $anggota->nama }}</h2>
    </x-slot>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.struktur-anggota.update', $anggota) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.struktur-anggota._form', ['anggota' => $anggota, 'bidangs' => $bidangs])
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                <a href="{{ route('admin.struktur-anggota.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>