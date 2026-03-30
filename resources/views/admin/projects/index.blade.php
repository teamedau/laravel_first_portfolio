@extends('layouts.admin')

@section('content')
<div class="admin-page">
    <div class="admin-page-header">
        <h1>Projects</h1>
        <a href="{{ route('admin.projects.create') }}" class="btn-primary">+ New project</a>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th>Launch</th>
                    <th>Votes</th>
                    <th>Collaborators</th>
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
                    <td>{{ $project->category ?? '—' }}</td>
                    <td><span class="status-badge status-{{ $project->status->value }}">{{ $project->status->value }}</span></td>
                    <td>{{ $project->progress }}%</td>
                    <td>{{ $project->launch_date?->format('M Y') ?? '—' }}</td>
                    <td>{{ $project->votes }}</td>
                    <td>{{ $project->collaborators_count ?: '—' }}</td>
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
                <tr><td colspan="8">No projects yet. <a href="{{ route('admin.projects.create') }}">Create your first one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $projects->links() }}
    </div>
</div>
@endsection
