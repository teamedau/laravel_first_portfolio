<section class="hero-section" id="home">

    <div class="hero-bg-grid"></div>
    <div class="hero-blob hero-blob--1" aria-hidden="true"></div>
    <div class="hero-blob hero-blob--2" aria-hidden="true"></div>

    <div class="container hero-inner hero-split">

        {{-- Left: text content --}}
        <div class="hero-content">

            <div class="hero-greeting" data-anim="fade">
                <span class="greeting-text">Hello, I'm</span>
                <span class="greeting-cursor">|</span>
            </div>

            <div class="hero-code-name" data-anim="fade">
                <span class="code-kw">const</span>
                <span class="code-var"> creator</span>
                <span class="code-op"> = </span>
                <span class="code-str">"Vivi"</span>
                <span class="code-punc">;</span>
            </div>

            <div class="hero-job-title" data-anim="fade">
                <span class="code-comment">// </span>Full Stack Developer
            </div>

            <p class="hero-sub" data-anim="fade">
                Building Vica Projects — a platform where ideas find their people.
                Follow real projects, vote for what excites you, and join as a tester before launch.
            </p>

            <div class="hero-cta-row" data-anim="fade">
                <a href="{{ route('projects.index') }}" class="btn-accent">
                    Explore Projects &nbsp;<i class="fas fa-arrow-right"></i>
                </a>
                <a href="{{ route('about') }}" class="btn-ghost">
                    About &nbsp;<i class="fas fa-user"></i>
                </a>
            </div>

            <div class="hero-social-row" data-anim="fade">
                <a href="https://www.linkedin.com/in/vivianacastrillonolave/" target="_blank" rel="noopener" class="hero-social-btn" title="LinkedIn">
                    <img src="/img/LinkedIn.png" alt="LinkedIn">
                </a>
                <a href="https://github.com/teamedau" target="_blank" rel="noopener" class="hero-social-btn" title="GitHub">
                    <img src="/img/GitHub.png" alt="GitHub">
                </a>
                <a href="mailto:hola@vivicastrillon.com.au" class="hero-social-btn hero-social-btn--icon" title="Email">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>

        </div>

        {{-- Right: logo + floating tech badges --}}
        <div class="hero-image-wrapper" data-anim="role">
            <div class="hero-image-glow"></div>
            <div class="hero-logo-frame">
                <img src="/logo.svg" alt="Vica Projects" class="hero-logo-img">
            </div>

            <div class="hero-tech-badge badge-1">
                <i class="fab fa-laravel"></i>
                <div class="badge-info">
                    <span class="badge-title">Laravel</span>
                    <span class="badge-sub">PHP · Blade · Eloquent</span>
                </div>
            </div>

            <div class="hero-tech-badge badge-2">
                <i class="fab fa-php"></i>
                <div class="badge-info">
                    <span class="badge-title">PHP</span>
                    <span class="badge-sub">Backend · OOP · APIs</span>
                </div>
            </div>

            <div class="hero-tech-badge badge-3">
                <i class="fab fa-css3-alt"></i>
                <div class="badge-info">
                    <span class="badge-title">Tailwind + Alpine</span>
                    <span class="badge-sub">CSS · JS · Animations</span>
                </div>
            </div>
        </div>

    </div>
</section>
