<section class="mb-5">
    <div class="mb-4">
        <h2 class="h5 fw-bold">{{ __('Update Password') }}</h2>
        <p class="text-muted">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
            <input type="password" id="current_password" name="current_password" class="form-control" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('New Password') }}</label>
            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

        @if (session('status') === 'password-updated')
            <div class="text-success mt-2">
                {{ __('Saved.') }}
            </div>
        @endif
    </form>
</section>
