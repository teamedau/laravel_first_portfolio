@extends('layouts.admin')

@section('content')
<div class="admin-page admin-page--form">
    <div class="admin-page-header">
        <h1>New project</h1>
        <a href="{{ route('admin.projects.index') }}" class="btn-secondary">← Back</a>
    </div>

    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="admin-form">
        @csrf

        <div class="admin-form-grid">
            <div class="form-group form-group--wide">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="@error('title') is-error @enderror">
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group form-group--wide">
                <label for="tagline">Tagline <small>One line that hooks people in</small></label>
                <input type="text" id="tagline" name="tagline" value="{{ old('tagline') }}" placeholder="e.g. The simplest way to track your ideas" class="@error('tagline') is-error @enderror">
                @error('tagline')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group form-group--wide">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" class="@error('description') is-error @enderror">{{ old('description') }}</textarea>
                @error('description')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="image">Project image</label>
                <input type="file" id="image" name="image" accept="image/*" class="@error('image') is-error @enderror">
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="tech">Tech stack <small>comma-separated</small></label>
                <input type="text" id="tech" name="tech" value="{{ old('tech') }}" placeholder="Laravel, Vue.js, Tailwind">
            </div>

            <div class="form-group">
                <label for="link">External link</label>
                <input type="url" id="link" name="link" value="{{ old('link') }}" placeholder="https://...">
                @error('link')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" id="category" name="category" value="{{ old('category') }}" placeholder="App, Tool, Game, SaaS...">
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="concept" {{ old('status') === 'concept' ? 'selected' : '' }}>Concept</option>
                    <option value="mvp"     {{ old('status') === 'mvp'     ? 'selected' : '' }}>MVP</option>
                    <option value="live"    {{ old('status') === 'live'    ? 'selected' : '' }}>Live</option>
                </select>
            </div>

            <div class="form-group">
                <label for="progress">Progress <span id="progress-value">{{ old('progress', 0) }}%</span></label>
                <input type="range" id="progress" name="progress" min="0" max="100" value="{{ old('progress', 0) }}"
                    oninput="document.getElementById('progress-value').textContent = this.value + '%'">
            </div>

            <div class="form-group">
                <label for="launch_date">Estimated launch date</label>
                <input type="date" id="launch_date" name="launch_date" value="{{ old('launch_date') }}">
            </div>

            <div class="form-group form-group--checkbox">
                <label>
                    <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                    Feature on homepage
                </label>
            </div>
        </div>

        <div class="admin-section">
            <h2>Collaborators</h2>
            <p class="admin-section-sub">Add people who contributed to this project.</p>

            <div id="collaborators-list"></div>

            <button type="button" onclick="addCollaborator()" class="btn-secondary" style="margin-top:8px;">
                + Add Collaborator
            </button>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn-primary">Create project</button>
            <a href="{{ route('admin.projects.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
function addCollaborator() {
    const row = document.createElement('div');
    row.className = 'collaborator-row';
    row.style.cssText = 'display:flex; gap:12px; margin-bottom:12px; align-items:center;';
    row.innerHTML = `
        <input type="text" name="collaborator_names[]" placeholder="Name" class="form-control" style="flex:1;">
        <input type="text" name="collaborator_roles[]" placeholder="Role (e.g. UI Design)" class="form-control" style="flex:1;">
        <input type="url" name="collaborator_urls[]" placeholder="https://github.com/..." class="form-control" style="flex:2;">
        <button type="button" onclick="this.closest('.collaborator-row').remove()" class="btn-danger-sm">Remove</button>
    `;
    document.getElementById('collaborators-list').appendChild(row);
}
</script>
@endpush
@endsection
