<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Vica Projects') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">

    {{-- Background glow --}}
    <div class="auth-blob auth-blob--left"  aria-hidden="true"></div>
    <div class="auth-blob auth-blob--right" aria-hidden="true"></div>

    {{-- Logo --}}
    <div class="auth-logo">
        <a href="{{ route('home') }}">
            <img src="/logo.svg" alt="Vica Projects" class="auth-logo-img">
        </a>
        <p class="auth-logo-sub">The project showcase platform</p>
    </div>

    {{-- Form card --}}
    <div class="auth-card">
        {{ $slot }}
    </div>

</body>
</html>
