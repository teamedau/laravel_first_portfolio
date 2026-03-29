<x-guest-layout>
    <h2 class="auth-form-title">Forgot password?</h2>
    <p class="auth-form-sub">Enter your email and we'll send you a reset link.</p>

    <x-auth-session-status class="auth-alert auth-alert--info mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="auth-error" />
        </div>

        <button type="submit" class="btn-primary auth-submit">Send reset link</button>

        <p class="auth-switch">
            Remember your password?
            <a href="{{ route('login') }}" class="auth-link">Sign in →</a>
        </p>
    </form>
</x-guest-layout>
