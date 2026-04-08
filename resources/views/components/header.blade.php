<header class="main-header" id="main-header">

    <div class="nav-brand">
        <a href="{{ route('home') }}" class="brand-logo">
            <span class="logo-bracket">&lt;</span>
            <span class="logo-text">Vica</span>
            <span class="logo-bracket">/&gt;</span>
        </a>
    </div>

    <nav class="nav" id="nav-menu">
        <ul class="nav-list">
            <li>
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link--active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'nav-link--active' : '' }}">
                    <i class="fas fa-rocket"></i>
                    <span>Projects</span>
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'nav-link--active' : '' }}">
                    <i class="fas fa-user"></i>
                    <span>About</span>
                </a>
            </li>

            @auth
                @if(auth()->user()->is_admin)
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <span>Admin</span>
                        </a>
                    </li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="nav-signout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Sign out</span>
                        </button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>

    <div class="nav-end">
        <a href="https://www.linkedin.com/in/vivianacastrillonolave/" target="_blank" rel="noopener" class="nav-social-icon" title="LinkedIn">
            <img src="/img/LinkedIn.png" alt="LinkedIn">
        </a>
        <a href="https://github.com/teamedau" target="_blank" rel="noopener" class="nav-social-icon" title="GitHub">
            <img src="/img/GitHub.png" alt="GitHub">
        </a>
        <button class="nav-hamburger" id="nav-hamburger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

</header>
