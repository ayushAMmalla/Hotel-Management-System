<section class="mb-5">
    <div class="mb-4">
        <h2 class="h5 fw-bold">{{ __('Profile Information') }}</h2>
        <p class="text-muted">{{ __("Update your account's profile information and email address.") }}</p>
    </div>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-warning small">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link p-0">{{ __('Click here to re-send the verification email.') }}</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small">{{ __('A new verification link has been sent to your email address.') }}</p>
                    @endif
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

        @if (session('status') === 'profile-updated')
            <div class="text-success mt-2">{{ __('Saved.') }}</div>
        @endif
    </form>
</section>
