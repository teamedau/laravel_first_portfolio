<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin — {{ config('app.name', 'Vica Projects') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="admin-body">

        <div class="admin-layout">
            <!-- Sidebar -->
            <aside class="admin-sidebar">
                <div class="admin-logo">
                    <a href="{{ route('home') }}">Vica Projects</a>
                </div>
                <nav class="admin-nav">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                        Projects
                    </a>
                    <a href="{{ route('home') }}" target="_blank">
                        View site →
                    </a>
                </nav>
                <div class="admin-user">
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Sign out</button>
                    </form>
                </div>
            </aside>

            <!-- Main content -->
            <div class="admin-main">
                @if(session('success'))
                    <div class="admin-alert admin-alert--success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="admin-alert admin-alert--error">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>
        </div>

    </body>
</html>
