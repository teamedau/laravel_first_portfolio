@extends('layouts.app')

@section('content')

{{-- ── Platform intro ── --}}
<section class="section-dark about-platform">
    <div class="container">
        <span class="section-eyebrow">What is this?</span>
        <h1>Build in public.<br><span class="about-gradient">Find your early tribe.</span></h1>
        <p class="about-platform-desc">
            Vica Projects is a space to explore ideas at every stage — concept, MVP, live — and connect
            with the people who want to be involved before something becomes a finished product.
            Follow along, vote, or sign up as a tester or early adopter. Early feedback is what turns
            a rough idea into something genuinely worth building.
        </p>

        <div class="about-pillars">
            <span class="about-pillar-tag about-pillar-tag--indigo">
                <span class="dot"></span> Follow projects you believe in
            </span>
            <span class="about-pillar-tag about-pillar-tag--teal">
                <span class="dot"></span> Sign up as tester or early adopter
            </span>
            <span class="about-pillar-tag about-pillar-tag--amber">
                <span class="dot"></span> Vote for what should be built
            </span>
        </div>

        <a href="{{ route('projects.index') }}" class="btn-primary">Browse projects</a>
    </div>
</section>

{{-- ── Founder profile ── --}}
<section class="about-founder-section">
    <div class="container">
        <div class="about-founder-grid">
            {{-- Photo + location --}}
            <div class="about-founder-photo-wrap">
                <img src="/vivi_pic.jpg" alt="Vivi" class="about-founder-photo">
                <h2 class="about-founder-name">Vivi</h2>
                <p class="about-founder-role">Founder &amp; Builder</p>
            </div>

            {{-- Bio --}}
            <div>
                <p class="about-founder-bio">
                    Hi! My name is <strong>Vivi</strong> — I'm finishing the Plus Bootcamp at
                    <strong>She Codes Australia</strong>, currently building <strong>Teamed</strong>,
                    and transitioning from <strong>15+ years in digital communications</strong>
                    into software engineering. Based in Brisbane.
                </p>
                <p class="about-founder-bio">
                    I created Vica Projects as a place to share real work in progress, get honest
                    feedback from real people, and connect with a community that's excited about
                    what's being built — not just what's already shipped.
                </p>

                {{-- Open To --}}
                <div class="about-open-to">
                    <span class="about-open-to-label">Open to</span>
                    <div class="about-open-to-tags">
                        <span class="about-open-to-tag">Intern roles</span>
                        <span class="about-open-to-tag">Graduate positions</span>
                        <span class="about-open-to-tag">Junior developer</span>
                        <span class="about-open-to-tag">Entry-level SE roles</span>
                        <span class="about-open-to-tag">Brisbane &amp; surrounds</span>
                    </div>
                </div>

                {{-- What I bring --}}
                <div class="about-brings">
                    <span class="about-brings-label">What I bring to a team</span>
                    <div class="about-traits">
                        <span class="about-trait">Clear, direct communication</span>
                        <span class="about-trait">Leadership and initiative</span>
                        <span class="about-trait">Organisation and follow-through</span>
                        <span class="about-trait">Patience and genuine commitment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Tech stack ── --}}
<section class="section-dark about-tech-section">
    <div class="container">
        <h2 class="about-section-title">Tech stack</h2>
        <p class="about-section-sub">Languages, frameworks, databases and tools I work with.</p>

        <div class="about-tech-categories">
            <div class="about-tech-group">
                <span class="about-tech-group-name">Languages</span>
                <div class="about-tech-tags">
                    <span class="about-tech-tag">JavaScript</span>
                    <span class="about-tech-tag">Python</span>
                    <span class="about-tech-tag">Java</span>
                    <span class="about-tech-tag">C#</span>
                    <span class="about-tech-tag">Ruby</span>
                    <span class="about-tech-tag">SQL</span>
                </div>
            </div>

            <div class="about-tech-group">
                <span class="about-tech-group-name">Frameworks</span>
                <div class="about-tech-tags">
                    <span class="about-tech-tag">React</span>
                    <span class="about-tech-tag">Node.js</span>
                    <span class="about-tech-tag">Django</span>
                    <span class="about-tech-tag">Rails</span>
                    <span class="about-tech-tag">Laravel</span>
                    <span class="about-tech-tag">.NET</span>
                </div>
            </div>

            <div class="about-tech-group">
                <span class="about-tech-group-name">Databases</span>
                <div class="about-tech-tags">
                    <span class="about-tech-tag">PostgreSQL</span>
                    <span class="about-tech-tag">MySQL</span>
                    <span class="about-tech-tag">SQLite</span>
                </div>
            </div>

            <div class="about-tech-group">
                <span class="about-tech-group-name">Tools</span>
                <div class="about-tech-tags">
                    <span class="about-tech-tag">Git</span>
                    <span class="about-tech-tag">GitHub</span>
                    <span class="about-tech-tag">VS Code</span>
                    <span class="about-tech-tag">Postman</span>
                    <span class="about-tech-tag">Figma</span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
