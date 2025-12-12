@extends('layouts.app')

@section('content')
<h1>New Project</h1>

<form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Title</label>
    <input name="title" value="{{ old('title') }}" required>
    <label>Description</label>
    <textarea name="description">{{ old('description') }}</textarea>
    <label>Link</label>
    <input name="link" value="{{ old('link') }}">
    <label>Tech</label>
    <input name="tech" value="{{ old('tech') }}">
    <label>Image</label>
    <input type="file" name="image">
    <button type="submit">Save</button>
</form>
@endsection
