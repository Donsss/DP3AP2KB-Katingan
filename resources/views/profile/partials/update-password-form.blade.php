<div class="card-header">
    <h5 class="card-title mb-0">{{ __('Update Password') }}</h5>
    <p class="card-text text-muted small">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
</div>
<div class="card-body">
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                 <div class="alert alert-success py-2 px-3 m-0" role="alert">
                    {{ __('Saved.') }}
                </div>
            @endif
        </div>
    </form>
</div>