@extends('layouts.app')

@section('content')
<div class="project-show">

    <!-- Project hero -->
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
                    <span class="project-stat-value">{{ $project->votes }}</span>
                    <span class="project-stat-label">Votes</span>
                </div>
                <div class="project-stat">
                    <span class="project-stat-value">{{ $project->progress }}%</span>
                    <span class="project-stat-label">Progress</span>
                </div>
            </div>

            <div style="display:flex; align-items:center; gap:16px;">
                <span class="status-badge status-{{ $project->status }}">{{ $project->status }}</span>
                @if($project->launch_date)
                    <span style="font-size:13px; color:var(--text-muted);">
                        Estimated launch: {{ $project->launch_date->format('M Y') }}
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
                        <span style="font-size:13px; color:var(--text-muted);">Project progress</span>
                        <span style="font-size:13px; font-family:var(--font-title);">{{ $project->progress }}%</span>
                    </div>
                    <div class="progress-bar" style="height:8px; --progress: {{ $project->progress }}%"></div>
                </div>

                <!-- Descripción -->
                @if($project->description)
                    <div style="margin-bottom: 32px;">
                        <h2 style="font-size:1.3rem; margin-bottom:16px;">About this project</h2>
                        <div style="color:var(--text-muted); line-height:1.8; white-space:pre-line;">{{ $project->description }}</div>
                    </div>
                @endif

                <!-- Tech stack -->
                @if($project->tech)
                    <div style="margin-bottom: 32px;">
                        <h3 style="font-size:1rem; margin-bottom:12px;">Tech stack</h3>
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
                        <h2 style="font-size:1.3rem; margin-bottom:24px;">What's new</h2>
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

                @if($project->collaborators->isNotEmpty())
                <section class="updates-timeline" style="margin-top: 48px;">
                    <h2 style="font-size:1.3rem; margin-bottom:24px;">Collaborators</h2>
                    <div style="display:flex; flex-direction:column; gap:16px;">
                        @foreach($project->collaborators as $collab)
                        <div class="timeline-item">
                            <div class="timeline-dot update"></div>
                            <div>
                                <strong style="color:var(--text-light); font-size:15px;">{{ $collab->name }}</strong>
                                <span style="color:var(--text-muted); font-size:13px; margin-left:8px;">{{ $collab->role }}</span>
                                @if($collab->url)
                                <br>
                                <a href="{{ $collab->url }}" target="_blank" rel="noopener noreferrer"
                                   style="color:var(--accent); font-size:13px;">{{ $collab->url }}</a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            <!-- Sidebar: acciones -->
            <div class="project-action-sidebar">
                <div class="project-action-card">

                    @auth
                        @if($userFollow)
                            <div class="already-following">
                                @if($userFollow === 'tester')
                                    ✓ You're a <strong>tester</strong> of this project
                                @else
                                    ✓ <strong>Following</strong> — you'll get email updates
                                @endif
                            </div>
                            <form method="POST" action="{{ route('projects.unfollow', $project) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn action-btn--secondary" style="margin-bottom:12px;">
                                    Unfollow
                                </button>
                            </form>
                        @else
                            <h3 style="margin-bottom:8px;">Join this project</h3>

                            <form method="POST" action="{{ route('projects.follow', $project) }}" style="margin-bottom:10px;">
                                @csrf
                                <input type="hidden" name="role" value="follower">
                                <button type="submit" class="action-btn action-btn--secondary">
                                    ✉ Follow & get updates
                                </button>
                            </form>

                            @if($project->link)
                            <form method="POST" action="{{ route('projects.follow', $project) }}">
                                @csrf
                                <input type="hidden" name="role" value="tester">
                                <button type="submit" class="action-btn action-btn--primary">
                                    🧪 Become a Tester
                                </button>
                            </form>
                            <p style="font-size:11px; color:var(--text-muted); margin-top:6px; text-align:center;">You'll be redirected to the platform to register</p>
                            @endif
                        @endif

                        <form method="POST" action="{{ route('projects.vote', $project) }}" style="margin-top:12px;">
                            @csrf
                            <button type="submit" class="vote-btn {{ $userVoted ? 'voted' : '' }}">
                                ▲ {{ $userVoted ? 'Voted' : 'Upvote' }} · {{ $project->votes }}
                            </button>
                        </form>

                    @else
                        <div class="login-prompt">
                            <p style="margin-bottom:12px; font-size:14px; color:var(--text-muted);">
                                Sign up to follow this project, upvote, and get updates.
                            </p>
                            <a href="{{ route('register') }}" class="action-btn action-btn--primary" style="display:block; margin-bottom:10px;">
                                Create a free account
                            </a>
                            <a href="{{ route('login') }}" class="action-btn action-btn--secondary" style="display:block;">
                                Sign in
                            </a>
                        </div>

                        <div style="margin-top:16px; text-align:center;">
                            <span style="font-family:var(--font-title); font-size:1.3rem; color:var(--text-muted);">▲ {{ $project->votes }}</span>
                            <p style="font-size:12px; color:var(--text-muted); margin-top:4px;">votes</p>
                        </div>
                    @endauth

                    @if($project->link)
                        <hr style="border-color: rgba(255,255,255,0.1); margin: 16px 0;">
                        <a href="{{ $project->link }}" target="_blank" rel="noopener" class="action-btn action-btn--secondary" style="display:block; text-align:center;">
                            View project →
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
