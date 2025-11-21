<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label text-secondary small fw-bold">EMAIL</label>
            <input type="email" name="email" class="form-control" id="email" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
        </div>

        <div class="mb-4">
            <label for="password" class="form-label text-secondary small fw-bold">PASSWORD</label>
            <input type="password" name="password" class="form-control" id="password" required>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
            <label class="form-check-label small text-secondary" for="remember_me">
                Ingat Saya
            </label>
        </div>

        <button type="submit" class="btn btn-primary-custom w-100">
            MASUK
        </button>

        <div class="forgot-password">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Lupa password anda?</a>
            @endif
        </div>
    </form>
</x-guest-layout>