@extends('layouts.app')

@section('content')
<section class="section-dark">
    <div class="container">

        <header style="margin-bottom: 40px;">
            <h2 class="section-title">All Projects</h2>
            <p class="section-subtitle">Explore projects in development, discover new ideas, and join as a tester.</p>
        </header>

        <!-- Filters and search -->
        <form method="GET" action="{{ route('projects.index') }}" style="margin-bottom: 40px;">
            <div style="display:flex; flex-wrap:wrap; gap:12px; align-items:center;">

                <!-- Search -->
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search projects..."
                    style="padding:8px 14px; border-radius:6px; border:1px solid rgba(255,255,255,0.2); background:rgba(255,255,255,0.05); color:var(--text-light); font-size:14px; min-width:200px;"
                >

                <!-- Status -->
                <select name="status" style="padding:8px 14px; border-radius:6px; border:1px solid rgba(255,255,255,0.2); background:var(--bg-dark); color:var(--text-muted); font-size:14px;">
                    <option value="">All statuses</option>
                    <option value="concept"  {{ request('status') === 'concept'  ? 'selected' : '' }}>Concept</option>
                    <option value="mvp"      {{ request('status') === 'mvp'      ? 'selected' : '' }}>MVP</option>
                    <option value="live"     {{ request('status') === 'live'     ? 'selected' : '' }}>Live</option>
                </select>

                <!-- Category -->
                @if($categories->count())
                <select name="category" style="padding:8px 14px; border-radius:6px; border:1px solid rgba(255,255,255,0.2); background:var(--bg-dark); color:var(--text-muted); font-size:14px;">
                    <option value="">All categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @endif

                <!-- Sort -->
                <select name="sort" style="padding:8px 14px; border-radius:6px; border:1px solid rgba(255,255,255,0.2); background:var(--bg-dark); color:var(--text-muted); font-size:14px;">
                    <option value="latest"   {{ request('sort', 'latest') === 'latest'   ? 'selected' : '' }}>Most recent</option>
                    <option value="votes"    {{ request('sort') === 'votes'    ? 'selected' : '' }}>Most voted</option>
                    <option value="progress" {{ request('sort') === 'progress' ? 'selected' : '' }}>Most advanced</option>
                </select>

                <button type="submit" style="padding:8px 20px; border-radius:6px; background:var(--accent); color:var(--bg-dark); font-family:var(--font-title); font-size:14px; cursor:pointer; border:none;">
                    Filter
                </button>

                @if(request()->hasAny(['q','status','category','sort']))
                    <a href="{{ route('projects.index') }}" style="font-size:13px; color:var(--text-muted);">Clear filters</a>
                @endif
            </div>
        </form>

        <!-- Projects grid -->
        @if($projects->count())
            <ul class="project-grid">
                @foreach($projects as $project)
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
                                <span class="project-card-votes">▲ {{ $project->votes }}</span>
                                <span class="project-card-view">View Project →</span>
                            </div>

                            <div class="progress-bar" style="--progress: {{ $project->progress }}%"></div>
                        </a>
                    </li>
                @endforeach
            </ul>

            <div style="margin-top: 40px;">
                {{ $projects->links() }}
            </div>

        @else
            <div style="text-align:center; padding: 60px 0;">
                <p>No projects found matching those filters.</p>
                <a href="{{ route('projects.index') }}" style="color:var(--accent); font-family:var(--font-title); margin-top:12px; display:inline-block;">View all projects</a>
            </div>
        @endif

    </div>
</section>
@endsection
