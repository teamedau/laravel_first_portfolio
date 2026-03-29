@extends('layouts.admin')

@section('content')
<div class="admin-page admin-page--form">
    <div class="admin-page-header">
        <h1>Edit: {{ $project->title }}</h1>
        <div class="admin-page-header-actions">
            <a href="{{ route('projects.show', $project) }}" target="_blank" class="btn-secondary">View on site →</a>
            <a href="{{ route('admin.projects.index') }}" class="btn-secondary">← Back</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="admin-form">
        @csrf @method('PUT')

        <div class="admin-form-grid">
            <div class="form-group form-group--wide">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required class="@error('title') is-error @enderror">
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group form-group--wide">
                <label for="tagline">Tagline</label>
                <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $project->tagline) }}">
            </div>

            <div class="form-group form-group--wide">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Project image</label>
                @if($project->image)
                    <div class="admin-current-image">
                        <img src="{{ Storage::url($project->image) }}" alt="Current image">
                        <span>Current image</span>
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*">
                <small>Leave blank to keep the current image.</small>
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="tech">Tech stack</label>
                <input type="text" id="tech" name="tech" value="{{ old('tech', $project->tech) }}" placeholder="Laravel, Vue.js, Tailwind">
            </div>

            <div class="form-group">
                <label for="link">External link</label>
                <input type="url" id="link" name="link" value="{{ old('link', $project->link) }}" placeholder="https://...">
                @error('link')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" id="category" name="category" value="{{ old('category', $project->category) }}">
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="concept" {{ old('status', $project->status) === 'concept' ? 'selected' : '' }}>Concept</option>
                    <option value="mvp"     {{ old('status', $project->status) === 'mvp'     ? 'selected' : '' }}>MVP</option>
                    <option value="live"    {{ old('status', $project->status) === 'live'    ? 'selected' : '' }}>Live</option>
                </select>
            </div>

            <div class="form-group">
                <label for="progress">Progress <span id="progress-value">{{ old('progress', $project->progress) }}%</span></label>
                <input type="range" id="progress" name="progress" min="0" max="100" value="{{ old('progress', $project->progress) }}"
                    oninput="document.getElementById('progress-value').textContent = this.value + '%'">
            </div>

            <div class="form-group">
                <label for="launch_date">Estimated launch date</label>
                <input type="date" id="launch_date" name="launch_date" value="{{ old('launch_date', $project->launch_date?->format('Y-m-d')) }}">
            </div>

            <div class="form-group form-group--checkbox">
                <label>
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}>
                    Feature on homepage
                </label>
            </div>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn-primary">Save changes</button>
            <a href="{{ route('admin.projects.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>

    <!-- Testers -->
    <div class="admin-section">
        <h2>Testers <span style="font-size:14px; font-weight:400; color:var(--text-muted);">({{ $testers->count() }})</span></h2>
        <p class="admin-section-sub">Users who signed up to test this project on the platform.</p>

        @if($testers->count())
        <table class="admin-table" style="margin-top:16px;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Signed up</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testers as $tester)
                <tr>
                    <td>{{ $tester->user->name }}</td>
                    <td>{{ $tester->user->email }}</td>
                    <td>{{ $tester->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p style="color:var(--text-muted); font-size:14px; margin-top:12px;">No testers yet.</p>
        @endif
    </div>

    <!-- Project updates / Changelog -->
    <div class="admin-section">
        <h2>Project updates</h2>
        <p class="admin-section-sub">Share progress, milestones, and news with your followers.</p>

        <form method="POST" action="{{ route('admin.projects.updates.store', $project) }}" class="admin-form admin-form--compact">
            @csrf
            <div class="form-group">
                <label for="update_title">Update title</label>
                <input type="text" id="update_title" name="title" placeholder="e.g. We've hit 50% — here's what's next">
            </div>
            <div class="form-group">
                <label for="update_content">Content</label>
                <textarea id="update_content" name="content" rows="3" placeholder="Tell your community what's been happening..."></textarea>
            </div>
            <div class="form-group">
                <label for="update_type">Type</label>
                <select id="update_type" name="type">
                    <option value="update">Update</option>
                    <option value="milestone">Milestone</option>
                    <option value="launch">Launch</option>
                </select>
            </div>
            <button type="submit" class="btn-primary">Publish update</button>
        </form>

        @if($project->updates->count())
        <div class="admin-updates-list">
            @foreach($project->updates as $update)
            <div class="admin-update-item">
                <span class="update-type-badge update-type-{{ $update->type }}">{{ $update->type }}</span>
                <strong>{{ $update->title }}</strong>
                <p>{{ $update->content }}</p>
                <small>{{ $update->created_at->format('d M Y') }}</small>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
