@extends('layouts.app')

@section('content')

{{-- HERO --}}
@include('components.hero')

{{-- PROYECTOS DESTACADOS --}}
@if($featured->count())
<section class="section-dark">
    <div class="container">
        <header style="margin-bottom: 40px;">
            <h2 class="section-title">Proyectos Destacados</h2>
            <p class="section-subtitle">Los proyectos que más interés están generando.</p>
        </header>

        <ul class="project-grid">
            @foreach($featured as $project)
                <li>
                    <a href="{{ route('projects.show', $project) }}" class="project-card">
                        <div class="project-image">
                            @if($project->image)
                                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}">
                            @endif
                        </div>

                        @if($project->category)
                            <span style="font-size:11px; text-transform:uppercase; letter-spacing:1px; color:var(--accent); font-family:var(--font-title);">{{ $project->category }}</span>
                        @endif

                        <h3>{{ $project->title }}</h3>

                        @if($project->tagline)
                            <p style="font-size:13px;">{{ $project->tagline }}</p>
                        @elseif($project->description)
                            <p style="font-size:13px;">{{ Str::limit($project->description, 90) }}</p>
                        @endif

                        <div class="tech-tags">
                            @foreach($project->tech_array as $tech)
                                <span class="tech-tag">{{ $tech }}</span>
                            @endforeach
                        </div>

                        <div class="project-card-meta">
                            <span class="status-badge status-{{ $project->status }}">{{ $project->status }}</span>
                            @if($project->votes > 0)
                                <span class="project-card-votes">▲ {{ $project->votes }}</span>
                            @endif
                        </div>

                        <div class="progress-bar" style="--progress: {{ $project->progress }}%"></div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

{{-- MÁS VOTADOS --}}
@if($topVoted->count())
<section class="section-light">
    <div class="container">
        <header style="margin-bottom: 40px;">
            <h2 class="section-title" style="color:var(--text-dark);">Más Votados</h2>
            <p class="section-subtitle" style="color:#4a4a68;">Los proyectos que la comunidad está apoyando.</p>
        </header>

        <ul class="project-grid">
            @foreach($topVoted as $project)
                <li>
                    <a href="{{ route('projects.show', $project) }}" class="project-card">
                        <div class="project-image">
                            @if($project->image)
                                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}">
                            @endif
                        </div>

                        <h3>{{ $project->title }}</h3>

                        @if($project->tagline)
                            <p style="font-size:13px;">{{ $project->tagline }}</p>
                        @endif

                        <div class="project-card-meta">
                            <span class="status-badge status-{{ $project->status }}">{{ $project->status }}</span>
                            <span class="project-card-votes">▲ {{ $project->votes }}</span>
                            <span style="font-size:12px; color:#4a4a68;">{{ $project->followers_count }} followers</span>
                        </div>

                        <div class="progress-bar" style="--progress: {{ $project->progress }}%"></div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

{{-- NUEVOS PROYECTOS --}}
@if($newest->count())
<section class="section-dark">
    <div class="container">
        <header style="margin-bottom: 40px; display:flex; justify-content:space-between; align-items:flex-end;">
            <div>
                <h2 class="section-title">Nuevos Proyectos</h2>
                <p class="section-subtitle">Ideas y experimentos recién publicados.</p>
            </div>
            <a href="{{ route('projects.index') }}" style="font-family:var(--font-title); color:var(--accent); font-size:15px; letter-spacing:1px;">
                Ver todos →
            </a>
        </header>

        <ul class="project-grid">
            @foreach($newest as $project)
                <li>
                    <a href="{{ route('projects.show', $project) }}" class="project-card">
                        <div class="project-image">
                            @if($project->image)
                                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}">
                            @endif
                        </div>

                        <h3>{{ $project->title }}</h3>

                        @if($project->tagline)
                            <p style="font-size:13px;">{{ $project->tagline }}</p>
                        @endif

                        <div class="tech-tags">
                            @foreach($project->tech_array as $tech)
                                <span class="tech-tag">{{ $tech }}</span>
                            @endforeach
                        </div>

                        <div class="project-card-meta">
                            <span class="status-badge status-{{ $project->status }}">{{ $project->status }}</span>
                            @if($project->launch_date)
                                <span style="font-size:11px; color:#4a4a68;">{{ $project->launch_date->format('M Y') }}</span>
                            @endif
                        </div>

                        <div class="progress-bar" style="--progress: {{ $project->progress }}%"></div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

@if($featured->isEmpty() && $topVoted->isEmpty() && $newest->isEmpty())
<section class="section-dark">
    <div class="container" style="text-align:center; padding: 80px 0;">
        <h2>No hay proyectos todavía</h2>
        <p style="margin-top:16px;">Pronto habrá proyectos aquí. Vuelve más tarde.</p>
    </div>
</section>
@endif

@endsection
