@extends('layouts.app')

@section('content')
<h1>{{ $project->title }}</h1>

@if($project->image)
<img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" style="max-width:400px;">
@endif

<p>{{ $project->description }}</p>
@if($project->link)
<p><a href="{{ $project->link }}" target="_blank">See Project</a></p>
@endif
@endsection
