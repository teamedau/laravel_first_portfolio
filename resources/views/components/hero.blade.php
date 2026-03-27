<section class="hero-section">
    <div class="hero-grid-bg" aria-hidden="true"></div>
    <div class="container hero-content">
        <span class="hero-eyebrow" data-anim="fade">— Vica Projects</span>
        <h1 class="hero-title">
            <span class="hero-line-wrap"><span class="hero-line-inner">Testing Ideas</span></span>
            <span class="hero-line-wrap"><span class="hero-line-inner">Today.</span></span>
        </h1>
        <p class="hero-sub" data-anim="fade">
            Follow real projects, vote for your favourites, and sign up as a tester before they launch.
        </p>
        <div class="hero-cta-row" data-anim="fade">
            <a href="{{ route('projects.index') }}" class="btn-primary">Browse projects</a>
            @guest
            <a href="{{ route('register') }}" class="btn-outline-light">Join free</a>
            @endguest
        </div>
    </div>
</section>
