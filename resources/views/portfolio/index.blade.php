<h1>Mi Portafolio</h1>

@foreach($projects as $project)
    <h2>{{ $project->title }}</h2>
    <p>{{ $project->description }}</p>
@endforeach
