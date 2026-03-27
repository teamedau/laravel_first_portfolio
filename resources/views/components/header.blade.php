<header class="main-header">
    <div class="logo">
        <a href="{{ route('home') }}" style="text-decoration:none;">
            <img src="/logo.svg" alt="Vica Projects" class="site-logo">
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
                        <button type="submit" class="nav-signout-btn">Sign out</button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>
</header>
