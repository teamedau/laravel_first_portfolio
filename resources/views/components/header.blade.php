<header class="main-header">
    <div class="logo">
        <a href="{{ route('home') }}" style="color:inherit; text-decoration:none;">
            <h1>Vica Projects</h1>
        </a>
    </div>

    <nav class="nav">
        <ul class="nav-list">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
            <li><a href="{{ route('about') }}">About</a></li>

            @auth
                @if(auth()->user()->is_admin)
                    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none; color:var(--text-dark); font-family:var(--font-title); font-size:inherit; padding:0; cursor:pointer;">
                            Salir
                        </button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Entrar</a></li>
                <li><a href="{{ route('register') }}" class="nav-cta">Registrarse</a></li>
            @endauth
        </ul>
    </nav>
</header>
