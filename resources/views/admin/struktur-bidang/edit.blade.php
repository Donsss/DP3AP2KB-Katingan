<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0">{{ __('Edit Section') }}</h2>
    </x-slot>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.struktur-bidang.update', $strukturBidang) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.struktur-bidang._form', ['strukturBidang' => $strukturBidang])
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                <a href="{{ route('admin.struktur-bidang.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>