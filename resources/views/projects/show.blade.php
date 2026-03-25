@extends('layouts.app')

@section('content')
<div class="project-show">

    <!-- Hero del proyecto -->
    <div class="project-show-hero">
        <div class="container">
            @if($project->category)
                <div class="project-show-category">{{ $project->category }}</div>
            @endif

            <h1 class="project-show-title">{{ $project->title }}</h1>

            @if($project->tagline)
                <p class="project-show-tagline">{{ $project->tagline }}</p>
            @endif

            <!-- Stats row -->
            <div class="project-stats-row">
                <div class="project-stat">
                    <span class="project-stat-value">{{ $project->followers_count }}</span>
                    <span class="project-stat-label">Followers</span>
                </div>
                <div class="project-stat">
                    <span class="project-stat-value">{{ $project->testers_count }}</span>
                    <span class="project-stat-label">Testers</span>
                </div>
                <div class="project-stat">
                    <span class="project-stat-value">{{ $project->early_adopters_count }}</span>
                    <span class="project-stat-label">Early Adopters</span>
                </div>
                <div class="project-stat">
                    <span class="project-stat-value">{{ $project->votes }}</span>
                    <span class="project-stat-label">Votos</span>
                </div>
                <div class="project-stat">
                    <span class="project-stat-value">{{ $project->progress }}%</span>
                    <span class="project-stat-label">Progreso</span>
                </div>
            </div>

            <div style="display:flex; align-items:center; gap:16px;">
                <span class="status-badge status-{{ $project->status }}">{{ $project->status }}</span>
                @if($project->launch_date)
                    <span style="font-size:13px; color:var(--text-muted);">
                        Lanzamiento estimado: {{ $project->launch_date->format('M Y') }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="container">
        <div class="project-show-grid">

            <!-- Columna izquierda -->
            <div>
                @if($project->image)
                    <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="project-show-image">
                @endif

                <!-- Barra de progreso -->
                <div style="margin-bottom: 32px;">
                    <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                        <span style="font-size:13px; color:var(--text-muted);">Progreso del proyecto</span>
                        <span style="font-size:13px; font-family:var(--font-title);">{{ $project->progress }}%</span>
                    </div>
                    <div class="progress-bar" style="height:8px; --progress: {{ $project->progress }}%"></div>
                </div>

                <!-- Descripción -->
                @if($project->description)
                    <div style="margin-bottom: 32px;">
                        <h2 style="font-size:1.3rem; margin-bottom:16px;">Sobre el proyecto</h2>
                        <div style="color:var(--text-muted); line-height:1.8; white-space:pre-line;">{{ $project->description }}</div>
                    </div>
                @endif

                <!-- Tech stack -->
                @if($project->tech)
                    <div style="margin-bottom: 32px;">
                        <h3 style="font-size:1rem; margin-bottom:12px;">Tech Stack</h3>
                        <div class="tech-tags">
                            @foreach($project->tech_array as $tech)
                                <span class="tech-tag">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Timeline de updates -->
                @if($project->updates->count())
                    <div class="updates-timeline">
                        <h2 style="font-size:1.3rem; margin-bottom:24px;">Updates</h2>
                        @foreach($project->updates as $update)
                        <div class="timeline-item">
                            <div class="timeline-dot {{ $update->type }}"></div>
                            <div>
                                <span class="update-type-badge update-type-{{ $update->type }}">{{ $update->type }}</span>
                                <h4 style="font-size:1rem; margin: 6px 0 4px;">{{ $update->title }}</h4>
                                <p style="font-size:14px;">{{ $update->content }}</p>
                                <small style="color:var(--text-muted); font-size:12px;">{{ $update->created_at->format('d M Y') }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Sidebar: acciones -->
            <div class="project-action-sidebar">
                <div class="project-action-card">

                    @auth
                        @if($userFollow)
                            <div class="already-following">
                                ✓ Siguiendo como <strong>{{ str_replace('_', ' ', $userFollow) }}</strong>
                            </div>
                            <form method="POST" action="{{ route('projects.unfollow', $project) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn action-btn--secondary" style="margin-bottom:12px;">
                                    Dejar de seguir
                                </button>
                            </form>
                        @else
                            <h3 style="margin-bottom:16px;">Únete al proyecto</h3>

                            <form method="POST" action="{{ route('projects.follow', $project) }}">
                                @csrf
                                <input type="hidden" name="role" value="follower">
                                <button type="submit" class="action-btn action-btn--secondary">
                                    Seguir proyecto
                                </button>
                            </form>

                            <form method="POST" action="{{ route('projects.follow', $project) }}">
                                @csrf
                                <input type="hidden" name="role" value="tester">
                                <button type="submit" class="action-btn action-btn--primary">
                                    Quiero ser Tester
                                </button>
                            </form>

                            <form method="POST" action="{{ route('projects.follow', $project) }}">
                                @csrf
                                <input type="hidden" name="role" value="early_adopter">
                                <button type="submit" class="action-btn action-btn--tertiary">
                                    Early Adopter
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('projects.vote', $project) }}" style="margin-top:12px;">
                            @csrf
                            <button type="submit" class="vote-btn {{ $userVoted ? 'voted' : '' }}">
                                ▲ {{ $userVoted ? 'Votado' : 'Votar' }} · {{ $project->votes }}
                            </button>
                        </form>

                    @else
                        <div class="login-prompt">
                            <p style="margin-bottom:12px; font-size:14px; color:#4a4a68;">
                                Regístrate para seguir este proyecto, votar y recibir updates.
                            </p>
                            <a href="{{ route('register') }}" class="action-btn action-btn--primary" style="display:block; margin-bottom:10px;">
                                Crear cuenta gratis
                            </a>
                            <a href="{{ route('login') }}" class="action-btn action-btn--secondary" style="display:block;">
                                Iniciar sesión
                            </a>
                        </div>

                        <div style="margin-top:16px; text-align:center;">
                            <span style="font-family:var(--font-title); font-size:1.3rem; color:var(--text-muted);">▲ {{ $project->votes }}</span>
                            <p style="font-size:12px; color:var(--text-muted); margin-top:4px;">votos</p>
                        </div>
                    @endauth

                    @if($project->link)
                        <hr style="border-color: rgba(255,255,255,0.1); margin: 16px 0;">
                        <a href="{{ $project->link }}" target="_blank" rel="noopener" class="action-btn action-btn--secondary" style="display:block; text-align:center;">
                            Ver proyecto externo →
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
