<x-guest-layout>
    
    <div class="text-center mb-4">
        <h3 class="fw-bold">Atur Ulang Kata Sandi</h3>
        <p class="text-secondary small">Silakan buat kata sandi baru untuk akun Anda.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label for="email" class="form-label text-secondary small fw-bold">ALAMAT EMAIL</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" 
                   type="email" name="email" 
                   value="{{ old('email', $request->email) }}" 
                   required autofocus autocomplete="username" readonly> 
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label text-secondary small fw-bold">KATA SANDI BARU</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" 
                   type="password" name="password" 
                   required autocomplete="new-password"
                   placeholder="Minimal 8 karakter">
            
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label text-secondary small fw-bold">KONFIRMASI KATA SANDI</label>
            <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" 
                   type="password" 
                   name="password_confirmation" required autocomplete="new-password"
                   placeholder="Ulangi kata sandi baru">
            
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary-custom">
                {{ __('SIMPAN KATA SANDI BARU') }}
            </button>
        </div>
    </form>
</x-guest-layout>