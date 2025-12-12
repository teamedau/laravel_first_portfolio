@extends('layouts.app')

@section('content')
<h1>Edit Project</h1>

<form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Title</label>
    <input name="title" value="{{ old('title', $project->title) }}" required>

    <label>Description</label>
    <textarea name="description">{{ old('description', $project->description) }}</textarea>

    <label>Link</label>
    <input name="link" value="{{ old('link', $project->link) }}">

    <label>Tech</label>
    <input name="tech" value="{{ old('tech', $project->tech) }}">

    <label>Image</label>
    <input type="file" name="image">

    @if($project->image)
        <p>Actual Image:</p>
        <img src="{{ asset('storage/' . $project->image) }}" width="200">
    @endif

    <button type="submit">Update</button>
</form>
@endsection
