<x-guest-layout>

    <div class="text-center">
        <h3 class="fw-bold mb-3">Lupa Kata Sandi?</h3>
    </div>

    <div class="mb-4 text-secondary small text-center">
        {{ __('Tidak masalah. Masukkan alamat email Anda yang terdaftar, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi baru ke email Anda.') }}
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-4 small" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label text-secondary small fw-bold">ALAMAT EMAIL <span class="text-danger">*</span></label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@kemenpppa.go.id">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid">
             <button type="submit" class="btn btn-primary-custom">
                {{ __('KIRIM TAUTAN RESET') }}
            </button>
        </div>

        <div class="mt-4 text-center">
             <a href="{{ route('login') }}" class="text-decoration-none text-secondary small">
                &larr; Kembali ke Halaman Login
             </a>
        </div>
    </form>
</x-guest-layout>