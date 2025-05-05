<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
    <div class="alert alert-success mb-4">
        {{ session('status') }}
    </div>
    @endif

    <div class="card shadow-sm" style="margin-left: 35%;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Login to Your Account</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                    @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">Remember me</label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        Log in
                    </button>

                </div>
                <div class="text-center mt-4">
                    Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register here</a>
                </div>
            </form>
        </div>
    </div>


</x-guest-layout>