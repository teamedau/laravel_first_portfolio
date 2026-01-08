@extends('layouts.app')

@section('content')

<!-- HERO -->
@include('components.hero')

<!-- PROJECTS -->
<section class="section-dark">
    <div class="container">

        <header class="mb-12">
            <h2 id="projects-title">
                Projects Lab
            </h2>

            <p>
                A selection of projects showcasing ideas, experiments, and work in progress.
            </p>
        </header>

        <ul class="project-grid">
            @forelse($projects as $project)
                <li>
                    <x-project-card
                        :title="$project->title" 
                        :description="$project->description" 
                        :image="$project->image"
                        :progress="$project->progress"
                        :tech="$project->tech"       
                        :status="$project->status"
                    />
                </li>
            @empty
                <li>No projects yet</li>
            @endforelse
        </ul>

    </div>
</section>

@endsection
