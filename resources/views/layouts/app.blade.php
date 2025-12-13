<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Portfolio</title>

    {{-- Si usas Tailwind o CSS propio, lo linkeas aquí --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body style="max-width: 800px; margin: 40px auto; font-family: Arial;">

    {{-- Navbar sencilla --}}
    <nav>
        <a href="{{ route('projects.index') }}">Home</a> |
        <a href="{{ route('projects.create') }}">New Project</a>
    </nav>

    <hr>

    {{-- Aquí se insertará el contenido de cada vista --}}
    @yield('content')

</body>
</html>
