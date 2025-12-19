@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">My Portfolio</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach($projects as $project)
        <x-project-card
            :title="$project->title"
            :description="Str::limit($project->description, 120)"
            :link="route('projects.show', $project)"
        />
    @endforeach
</div>

{{ $projects->links() }}
@endsection
