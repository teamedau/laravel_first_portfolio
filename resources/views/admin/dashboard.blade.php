@extends('layouts.admin')

@section('content')
<div class="admin-page">
    <div class="admin-page-header">
        <h1>Dashboard</h1>
        <a href="{{ route('admin.projects.create') }}" class="btn-primary">+ New project</a>
    </div>

    <!-- Stats -->
    <div class="admin-stats">
        <div class="admin-stat-card">
            <span class="admin-stat-value">{{ $stats['total_projects'] }}</span>
            <span class="admin-stat-label">Total projects</span>
        </div>
        <div class="admin-stat-card">
            <span class="admin-stat-value">{{ $stats['by_status']['concept'] ?? 0 }}</span>
            <span class="admin-stat-label">Concept</span>
        </div>
        <div class="admin-stat-card">
            <span class="admin-stat-value">{{ $stats['by_status']['mvp'] ?? 0 }}</span>
            <span class="admin-stat-label">MVP</span>
        </div>
        <div class="admin-stat-card">
            <span class="admin-stat-value">{{ $stats['by_status']['live'] ?? 0 }}</span>
            <span class="admin-stat-label">Live</span>
        </div>
        <div class="admin-stat-card">
            <span class="admin-stat-value">{{ $stats['total_users'] }}</span>
            <span class="admin-stat-label">Users</span>
        </div>
        <div class="admin-stat-card">
            <span class="admin-stat-value">{{ $stats['total_followers'] }}</span>
            <span class="admin-stat-label">Followers</span>
        </div>
        <div class="admin-stat-card">
            <span class="admin-stat-value">{{ $stats['total_votes'] }}</span>
            <span class="admin-stat-label">Total votes</span>
        </div>
    </div>

    <!-- Projects list -->
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th>Votes</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>
                        <strong>{{ $project->title }}</strong>
                        @if($project->tagline)
                            <span class="admin-table-sub">{{ $project->tagline }}</span>
                        @endif
                    </td>
                    <td><span class="status-badge status-{{ $project->status }}">{{ $project->status }}</span></td>
                    <td>{{ $project->progress }}%</td>
                    <td>{{ $project->votes }}</td>
                    <td>{{ $project->featured ? '★' : '—' }}</td>
                    <td class="admin-table-actions">
                        <a href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                        <a href="{{ route('projects.show', $project) }}" target="_blank">View</a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6">No projects yet. <a href="{{ route('admin.projects.create') }}">Create your first one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
