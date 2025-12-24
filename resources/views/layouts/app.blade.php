<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <!-- Google Fonts y Tailwind -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cause:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="antialiased bg-[var(--bg-dark)] text-[var(--text-light)] font-[var(--font-body)]">

    <!-- HEADER -->
    <x-header />

    <!-- HERO / Main content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <x-footer />

</body>
</html>
