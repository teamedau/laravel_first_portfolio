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
            <span class="admin-stat-label">Projects</span>
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
            <span class="admin-stat-value">{{ $stats['total_testers'] }}</span>
            <span class="admin-stat-label">Testers</span>
        </div>
        <div class="admin-stat-card">
            <span class="admin-stat-value">{{ $stats['total_votes'] }}</span>
            <span class="admin-stat-label">Votes</span>
        </div>
    </div>

    <!-- Charts -->
    <div class="admin-charts">
        <div class="admin-chart-card">
            <div class="admin-chart-title">Projects by status</div>
            <div class="admin-chart-inner">
                <canvas id="chartStatus"></canvas>
            </div>
        </div>

        <div class="admin-chart-card">
            <div class="admin-chart-title">Community</div>
            <div class="admin-chart-inner">
                <canvas id="chartEngagement"></canvas>
            </div>
        </div>

        <div class="admin-chart-card">
            <div class="admin-chart-title">Top voted projects</div>
            <div class="admin-chart-inner admin-chart-inner--bar">
                <canvas id="chartVotes"></canvas>
            </div>
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
                    <td><span class="status-badge status-{{ $project->status->value }}">{{ $project->status->value }}</span></td>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('chartStatus'), {
    type: 'doughnut',
    data: {
        labels: @json($chartStatus['labels']),
        datasets: [{
            data: @json($chartStatus['data']),
            backgroundColor: ['#94a3b8', '#6366f1', '#10b981'],
            borderWidth: 0,
            hoverOffset: 6,
        }]
    },
    options: {
        cutout: '68%',
        plugins: { legend: { position: 'bottom', labels: { font: { size: 11 }, padding: 12, boxWidth: 10 } } },
    }
});

new Chart(document.getElementById('chartEngagement'), {
    type: 'doughnut',
    data: {
        labels: @json($chartEngagement['labels']),
        datasets: [{
            data: @json($chartEngagement['data']),
            backgroundColor: ['#6366f1', '#ec4899'],
            borderWidth: 0,
            hoverOffset: 6,
        }]
    },
    options: {
        cutout: '68%',
        plugins: { legend: { position: 'bottom', labels: { font: { size: 11 }, padding: 12, boxWidth: 10 } } },
    }
});

new Chart(document.getElementById('chartVotes'), {
    type: 'bar',
    data: {
        labels: @json($chartVotes['labels']),
        datasets: [{
            label: 'Votes',
            data: @json($chartVotes['data']),
            backgroundColor: '#6366f1',
            borderRadius: 5,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } }, grid: { color: '#f1f5f9' } },
            x: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});
</script>
@endsection
