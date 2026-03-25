@extends('layouts.admin')

@section('content')
<div class="admin-page admin-page--form">
    <div class="admin-page-header">
        <h1>Editar: {{ $project->title }}</h1>
        <div class="admin-page-header-actions">
            <a href="{{ route('projects.show', $project) }}" target="_blank" class="btn-secondary">Ver en sitio →</a>
            <a href="{{ route('admin.projects.index') }}" class="btn-secondary">← Volver</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="admin-form">
        @csrf @method('PUT')

        <div class="admin-form-grid">
            <!-- Título -->
            <div class="form-group form-group--wide">
                <label for="title">Título *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required class="@error('title') is-error @enderror">
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <!-- Tagline -->
            <div class="form-group form-group--wide">
                <label for="tagline">Tagline</label>
                <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $project->tagline) }}">
            </div>

            <!-- Descripción -->
            <div class="form-group form-group--wide">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" rows="5">{{ old('description', $project->description) }}</textarea>
            </div>

            <!-- Imagen actual -->
            <div class="form-group">
                <label for="image">Imagen del proyecto</label>
                @if($project->image)
                    <div class="admin-current-image">
                        <img src="{{ Storage::url($project->image) }}" alt="Imagen actual">
                        <span>Imagen actual</span>
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*">
                <small>Dejar vacío para mantener la imagen actual.</small>
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <!-- Tech stack -->
            <div class="form-group">
                <label for="tech">Tech stack</label>
                <input type="text" id="tech" name="tech" value="{{ old('tech', $project->tech) }}" placeholder="Laravel, Vue.js, Tailwind">
            </div>

            <!-- Link externo -->
            <div class="form-group">
                <label for="link">Link externo</label>
                <input type="url" id="link" name="link" value="{{ old('link', $project->link) }}" placeholder="https://...">
                @error('link')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <!-- Categoría -->
            <div class="form-group">
                <label for="category">Categoría</label>
                <input type="text" id="category" name="category" value="{{ old('category', $project->category) }}">
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="concept" {{ old('status', $project->status) === 'concept' ? 'selected' : '' }}>Concept</option>
                    <option value="mvp"     {{ old('status', $project->status) === 'mvp'     ? 'selected' : '' }}>MVP</option>
                    <option value="live"    {{ old('status', $project->status) === 'live'    ? 'selected' : '' }}>Live</option>
                </select>
            </div>

            <!-- Progreso -->
            <div class="form-group">
                <label for="progress">Progreso <span id="progress-value">{{ old('progress', $project->progress) }}%</span></label>
                <input type="range" id="progress" name="progress" min="0" max="100" value="{{ old('progress', $project->progress) }}"
                    oninput="document.getElementById('progress-value').textContent = this.value + '%'">
            </div>

            <!-- Fecha de lanzamiento -->
            <div class="form-group">
                <label for="launch_date">Fecha estimada de lanzamiento</label>
                <input type="date" id="launch_date" name="launch_date" value="{{ old('launch_date', $project->launch_date?->format('Y-m-d')) }}">
            </div>

            <!-- Destacado -->
            <div class="form-group form-group--checkbox">
                <label>
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}>
                    Destacar en home
                </label>
            </div>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn-primary">Guardar cambios</button>
            <a href="{{ route('admin.projects.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>

    <!-- Updates / Changelog -->
    <div class="admin-section">
        <h2>Updates del proyecto</h2>
        <p class="admin-section-sub">Comparte avances, hitos y noticias con tus seguidores.</p>

        <form method="POST" action="{{ route('admin.projects.updates.store', $project) }}" class="admin-form admin-form--compact">
            @csrf
            <div class="form-group">
                <label for="update_title">Título del update</label>
                <input type="text" id="update_title" name="title" placeholder="Ej: ¡Llegamos al 50% del desarrollo!">
            </div>
            <div class="form-group">
                <label for="update_content">Contenido</label>
                <textarea id="update_content" name="content" rows="3" placeholder="Cuéntale a tu comunidad qué pasó..."></textarea>
            </div>
            <div class="form-group">
                <label for="update_type">Tipo</label>
                <select id="update_type" name="type">
                    <option value="update">Update</option>
                    <option value="milestone">Milestone</option>
                    <option value="launch">Launch</option>
                </select>
            </div>
            <button type="submit" class="btn-primary">Publicar update</button>
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
