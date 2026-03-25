@extends('layouts.admin')

@section('content')
<div class="admin-page admin-page--form">
    <div class="admin-page-header">
        <h1>Nuevo proyecto</h1>
        <a href="{{ route('admin.projects.index') }}" class="btn-secondary">← Volver</a>
    </div>

    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="admin-form">
        @csrf

        <div class="admin-form-grid">
            <!-- Título -->
            <div class="form-group form-group--wide">
                <label for="title">Título *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="@error('title') is-error @enderror">
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <!-- Tagline -->
            <div class="form-group form-group--wide">
                <label for="tagline">Tagline <small>Una línea que engancha</small></label>
                <input type="text" id="tagline" name="tagline" value="{{ old('tagline') }}" placeholder="Ej: La forma más simple de gestionar tus tareas" class="@error('tagline') is-error @enderror">
                @error('tagline')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <!-- Descripción -->
            <div class="form-group form-group--wide">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" rows="5" class="@error('description') is-error @enderror">{{ old('description') }}</textarea>
                @error('description')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <!-- Imagen -->
            <div class="form-group">
                <label for="image">Imagen del proyecto</label>
                <input type="file" id="image" name="image" accept="image/*" class="@error('image') is-error @enderror">
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <!-- Tech stack -->
            <div class="form-group">
                <label for="tech">Tech stack <small>separado por comas</small></label>
                <input type="text" id="tech" name="tech" value="{{ old('tech') }}" placeholder="Laravel, Vue.js, Tailwind">
            </div>

            <!-- Link externo -->
            <div class="form-group">
                <label for="link">Link externo</label>
                <input type="url" id="link" name="link" value="{{ old('link') }}" placeholder="https://...">
                @error('link')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <!-- Categoría -->
            <div class="form-group">
                <label for="category">Categoría</label>
                <input type="text" id="category" name="category" value="{{ old('category') }}" placeholder="App, Tool, Game, SaaS...">
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="concept" {{ old('status') === 'concept' ? 'selected' : '' }}>Concept</option>
                    <option value="mvp"     {{ old('status') === 'mvp'     ? 'selected' : '' }}>MVP</option>
                    <option value="live"    {{ old('status') === 'live'    ? 'selected' : '' }}>Live</option>
                </select>
            </div>

            <!-- Progreso -->
            <div class="form-group">
                <label for="progress">Progreso <span id="progress-value">{{ old('progress', 0) }}%</span></label>
                <input type="range" id="progress" name="progress" min="0" max="100" value="{{ old('progress', 0) }}"
                    oninput="document.getElementById('progress-value').textContent = this.value + '%'">
            </div>

            <!-- Fecha de lanzamiento -->
            <div class="form-group">
                <label for="launch_date">Fecha estimada de lanzamiento</label>
                <input type="date" id="launch_date" name="launch_date" value="{{ old('launch_date') }}">
            </div>

            <!-- Destacado -->
            <div class="form-group form-group--checkbox">
                <label>
                    <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                    Destacar en home
                </label>
            </div>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn-primary">Crear proyecto</button>
            <a href="{{ route('admin.projects.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
