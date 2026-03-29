<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Vica Projects') }}</title>

        <!-- Fonts: loaded via @import in app.css (Bebas Neue + Nunito) -->

        <!-- GSAP (must load before app.js) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body>
        @include('components.header')

        <main>
            @if(session('success'))
                <div class="flash flash--success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="flash flash--error">{{ session('error') }}</div>
            @endif
            @if(session('info'))
                <div class="flash flash--info">{{ session('info') }}</div>
            @endif

            @yield('content')
        </main>

        @include('components.footer')
        @stack('scripts')
    </body>
</html>
