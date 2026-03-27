<x-guest-layout>
    <h2 class="auth-form-title">Sign in</h2>
    <p class="auth-form-sub">Welcome back.</p>

    <x-auth-session-status class="auth-alert auth-alert--info mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="auth-error" />
        </div>

        <div class="auth-field">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="auth-error" />
        </div>

        <div class="auth-remember">
            <label class="auth-check-label">
                <input type="checkbox" name="remember" class="auth-checkbox">
                <span>Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="btn-primary auth-submit">Sign in</button>

        <p class="auth-switch">
            Don't have an account?
            <a href="{{ route('register') }}" class="auth-link">Register free →</a>
        </p>
    </form>
</x-guest-layout>
