@extends('layouts.app')

@section('content')

{{-- HERO --}}
@include('components.hero')

{{-- HOW IT WORKS --}}
<section class="roles-section section-dark">
    <div class="container">
        <header style="text-align:center; margin-bottom: 48px;">
            <h2 class="section-title">What Vica Projects is about</h2>
            <p class="section-subtitle">A platform for every stage of the journey.</p>
        </header>
        <div class="hero-roles">

            <div class="role-card role-card--creator" data-anim="role">
                <div class="role-figure">
                    <img src="/img/thieve.png" alt="Creator">
                </div>
                <div class="role-text">
                    <strong>Creator</strong>
                    <p>Here I am sharing projects, ideas, and concepts to inspire and connect with others.</p>
                </div>
            </div>

            <div class="role-card role-card--tester" data-anim="role">
                <div class="role-figure">
                    <img src="/img/zombie.png" alt="Tester">
                </div>
                <div class="role-text">
                    <strong>Tester</strong>
                    <p>Finding people willing to test new products is hard, but your feedback helps make them better.</p>
                </div>
            </div>

            <div class="role-card role-card--adopter" data-anim="role">
                <div class="role-figure">
                    <img src="/img/hero.png" alt="Early Adopter">
                </div>
                <div class="role-text">
                    <strong>New Products</strong>
                    <p>Finally together we can build the future — one idea at a time.</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- PROJECTS GRID --}}
@if($allProjects->count())
<section class="section-light">
    <div class="container">
        <header style="margin-bottom: 40px; display:flex; justify-content:space-between; align-items:flex-end;">
            <div>
                <h2 class="section-title" style="color:var(--text-dark);">Projects</h2>
                <p class="section-subtitle" style="color:var(--text-muted);">Real ideas at every stage of development.</p>
            </div>
            <a href="{{ route('projects.index') }}" style="font-family:var(--font-title); color:var(--accent-solid); font-size:15px; letter-spacing:1px;">
                View all →
            </a>
        </header>

        <ul class="project-grid">
            @foreach($allProjects as $project)
                <li>
                    <a href="{{ route('projects.show', $project) }}" class="project-card">

                        <div class="project-image">
                            @if($project->image)
                                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}">
                            @else
                                <div class="project-image-placeholder">
                                    <i class="fas fa-code"></i>
                                </div>
                            @endif
                            <div class="project-card-overlay">
                                <span><i class="fas fa-external-link-alt"></i> View Project</span>
                            </div>
                        </div>

                        @if($project->category)
                            <span class="project-card-category">{{ $project->category }}</span>
                        @endif

                        <h3>{{ $project->title }}</h3>

                        @if($project->tagline)
                            <p style="font-size:13px;">{{ $project->tagline }}</p>
                        @elseif($project->description)
                            <p style="font-size:13px;">{{ Str::limit($project->description, 80) }}</p>
                        @endif

                        <div class="tech-tags">
                            @foreach($project->tech_array as $tech)
                                <span class="tech-tag">{{ $tech }}</span>
                            @endforeach
                        </div>

                        <div class="project-card-meta">
                            <span class="project-card-votes">▲ {{ $project->votes }}</span>
                            <span class="project-card-view">View Project →</span>
                        </div>

                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

{{-- CONTACT --}}
<section class="section-dark contact-home">
    <div class="container" style="text-align:center; padding: 80px 0;">
        <h2 class="section-title">Let's talk</h2>
        <p class="section-subtitle" style="margin-top: 16px; margin-bottom: 40px;">
            Got a project idea or want to collaborate? Reach out directly.
        </p>
        <a href="mailto:hola@vivicastrillon.com.au" class="contact-email-link">
            <i class="fas fa-envelope"></i>
            hola@vivicastrillon.com.au
        </a>
    </div>
</section>

@if($allProjects->isEmpty())
<section class="section-dark">
    <div class="container" style="text-align:center; padding: 80px 0;">
        <h2>No projects yet</h2>
        <p style="margin-top:16px;">Projects are on their way. Check back soon.</p>
    </div>
</section>
@endif

@endsection
