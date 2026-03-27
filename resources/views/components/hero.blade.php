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
                <div class="role-figure role-figure--amber">
                    <svg class="role-person" viewBox="0 0 56 60" fill="none" aria-hidden="true">
                        <circle cx="28" cy="15" r="11" fill="currentColor" opacity="0.9"/>
                        <path d="M10 50c0-9.941 8.059-18 18-18s18 8.059 18 18" stroke="currentColor" stroke-width="4" stroke-linecap="round" fill="none"/>
                        <path d="M28 3 L31 9 L28 7 L25 9 Z" fill="currentColor" opacity="0.6"/>
                        <circle cx="33" cy="5" r="2" fill="currentColor" opacity="0.4"/>
                        <circle cx="23" cy="4" r="1.5" fill="currentColor" opacity="0.3"/>
                    </svg>
                </div>
                <div class="role-text">
                    <strong>Creator</strong>
                    <p>Share your project at any stage and build an audience before you launch.</p>
                </div>
            </div>

            {{-- Tester --}}
            <div class="role-card role-card--tester" data-anim="role">
                <div class="role-figure role-figure--violet">
                    <svg class="role-person" viewBox="0 0 56 60" fill="none" aria-hidden="true">
                        <circle cx="28" cy="15" r="11" fill="currentColor" opacity="0.9"/>
                        <path d="M10 50c0-9.941 8.059-18 18-18s18 8.059 18 18" stroke="currentColor" stroke-width="4" stroke-linecap="round" fill="none"/>
                        <circle cx="38" cy="46" r="6" stroke="currentColor" stroke-width="2.5" fill="none" opacity="0.7"/>
                        <path d="M43 51 L49 57" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" opacity="0.7"/>
                    </svg>
                </div>
                <div class="role-text">
                    <strong>Tester</strong>
                    <p>Get early access to products taking shape — and help make them better.</p>
                </div>
            </div>

            {{-- Early Adopter --}}
            <div class="role-card role-card--adopter" data-anim="role">
                <div class="role-figure role-figure--teal">
                    <svg class="role-person" viewBox="0 0 56 60" fill="none" aria-hidden="true">
                        <circle cx="28" cy="15" r="11" fill="currentColor" opacity="0.9"/>
                        <path d="M10 50c0-9.941 8.059-18 18-18s18 8.059 18 18" stroke="currentColor" stroke-width="4" stroke-linecap="round" fill="none"/>
                        <path d="M35 38 L40 28 L45 38" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" opacity="0.7"/>
                        <path d="M40 28 L40 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                    </svg>
                </div>
                <div class="role-text">
                    <strong>Early Adopter</strong>
                    <p>Be first when it launches. Your support shapes what gets built next.</p>
                </div>
            </div>

        </div>
    </div>
</section>
