<section class="hero-section">
    {{-- Background glow blobs --}}
    <div class="hero-blob hero-blob--1" aria-hidden="true"></div>
    <div class="hero-blob hero-blob--2" aria-hidden="true"></div>

    <div class="container hero-inner">

        {{-- Badge --}}
        <div class="hero-badge" data-anim="fade">
            <span class="hero-badge-dot"></span>
            Project showcase platform
        </div>

        {{-- Headline --}}
        <h1 class="hero-title">
            <span class="hero-line-wrap"><span class="hero-line-inner">Where ideas</span></span>
            <span class="hero-line-wrap"><span class="hero-line-inner hero-gradient-text">find their people.</span></span>
        </h1>

        {{-- Subtext --}}
        <p class="hero-sub" data-anim="fade">
            Follow real projects, vote for what excites you,
            and sign up as a tester before anything goes public.
        </p>

        {{-- CTAs --}}
        <div class="hero-cta-row" data-anim="fade">
            <a href="{{ route('projects.index') }}" class="btn-accent">Explore projects</a>
            @guest
            <a href="{{ route('register') }}" class="btn-ghost">Join the community →</a>
            @endguest
        </div>

        {{-- Role cards --}}
        <div class="hero-roles">

            {{-- Creator --}}
            <div class="role-card role-card--creator" data-anim="role">
                <div class="role-figure">
                    <img src="/img/thieve.png" alt="Creator">
                </div>
                <div class="role-text">
                    <strong>Creator</strong>
                    <p>Share your project at any stage and build an audience before you launch.</p>
                </div>
            </div>

            {{-- Tester --}}
            <div class="role-card role-card--tester" data-anim="role">
                <div class="role-figure">
                    <img src="/img/zombie.png" alt="Tester">
                </div>
                <div class="role-text">
                    <strong>Tester</strong>
                    <p>Get early access to products taking shape — and help make them better.</p>
                </div>
            </div>

            {{-- Early Adopter --}}
            <div class="role-card role-card--adopter" data-anim="role">
                <div class="role-figure">
                    <img src="/img/hero.png" alt="Early Adopter">
                </div>
                <div class="role-text">
                    <strong>Early Adopter</strong>
                    <p>Be first when it launches. Your support shapes what gets built next.</p>
                </div>
            </div>

        </div>
    </div>
</section>
