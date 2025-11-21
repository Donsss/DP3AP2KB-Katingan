<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0">
            {{ __('Tambah User Baru') }}
        </h2>
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                {{-- Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- Role --}}
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="">Pilih Role...</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Opsi Password --}}
                <div class="mb-3">
                    <label class="form-label">Opsi Password</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="password_option" id="pass_auto" value="auto" checked onchange="togglePasswordInput(false)">
                        <label class="form-check-label" for="pass_auto">
                            Generate Password Otomatis
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="password_option" id="pass_manual" value="manual" onchange="togglePasswordInput(true)">
                        <label class="form-check-label" for="pass_manual">
                            Masukkan Password Manual
                        </label>
                    </div>
                </div>

                {{-- Input Password Manual (Hidden by default) --}}
                <div class="mb-3" id="password-manual-container" style="display: none;">
                    <label for="password" class="form-label">Password Manual</label>
                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Buat User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
    
    @push('scripts')
    <script>
        function togglePasswordInput(show) {
            document.getElementById('password-manual-container').style.display = show ? 'block' : 'none';
        }
    </script>
    @endpush
</x-app-layout>