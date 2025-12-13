@extends('layouts.app')

@section('content')
<h1>My Portfolio</h1>

@foreach($projects as $project)
<div>
    <h3><a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a></h3>
    <p>{{ Str::limit($project->description, 120) }}</p>
</div>
@endforeach

{{ $projects->links() }}
@endsection
