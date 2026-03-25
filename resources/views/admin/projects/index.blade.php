@extends('layouts.admin')

@section('content')
<div class="admin-page">
    <div class="admin-page-header">
        <h1>Proyectos</h1>
        <a href="{{ route('admin.projects.create') }}" class="btn-primary">+ Nuevo proyecto</a>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Categoría</th>
                    <th>Status</th>
                    <th>Progreso</th>
                    <th>Lanzamiento</th>
                    <th>Votos</th>
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
                    <td>{{ $project->category ?? '—' }}</td>
                    <td><span class="status-badge status-{{ $project->status }}">{{ $project->status }}</span></td>
                    <td>{{ $project->progress }}%</td>
                    <td>{{ $project->launch_date?->format('M Y') ?? '—' }}</td>
                    <td>{{ $project->votes }}</td>
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
                <tr><td colspan="7">No hay proyectos. <a href="{{ route('admin.projects.create') }}">Crea el primero</a>.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $projects->links() }}
    </div>
</div>
@endsection
