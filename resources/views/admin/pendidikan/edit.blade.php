<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0">
            {{ __('Edit Riwayat Pendidikan') }}
        </h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.pendidikan.update', $riwayatPendidikan) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pendidikan.partials.form-fields', ['riwayat' => $riwayatPendidikan])
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                <a href="{{ route('admin.pendidikan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>