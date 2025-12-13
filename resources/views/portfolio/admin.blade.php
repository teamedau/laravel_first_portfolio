<h1>Admin - Projects</h1>

<a href="/admin/projects/create">Create New</a>

@foreach($projects as $project)
    <p>{{ $project->title }}</p>
@endforeach
