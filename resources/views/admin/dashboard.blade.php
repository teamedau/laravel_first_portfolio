@extends('layouts.admin')

@section('content')
<div class="admin-page">
    <div class="admin-page-header">
        <h1>Dashboard</h1>
        <a href="{{ route('admin.projects.create') }}" class="btn-primary">+ Nuevo proyecto</a>
    </div>

    <!-- Stats -->
    <div class="admin-stats">
        <div class="admin-stat-card">
            <span class="admin-stat-value">{{ $stats['total_projects'] }}</span>
            <span class="admin-stat-label">Proyectos totales</span>
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
            <span class="admin-stat-label">Usuarios</span>
        </div>
        <div class="admin-stat-card">
            <span class="admin-stat-value">{{ $stats['total_followers'] }}</span>
            <span class="admin-stat-label">Followers</span>
        </div>
    </div>

    <!-- Projects list -->
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Status</th>
                    <th>Progreso</th>
                    <th>Votos</th>
                    <th>Destacado</th>
                    <th>Acciones</th>
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
                        <a href="{{ route('admin.projects.edit', $project) }}">Editar</a>
                        <a href="{{ route('projects.show', $project) }}" target="_blank">Ver</a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('¿Eliminar este proyecto?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6">No hay proyectos todavía. <a href="{{ route('admin.projects.create') }}">Crea el primero</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
