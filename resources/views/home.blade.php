@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="max-w-6xl mx-auto px-6 py-20">
    <h1 class="text-4xl font-semibold mb-6">
        Experimental projects, built in public
    </h1>

    <p class="text-gray-600">
        Explore concepts, MVPs and live products.
    </p>
</section>

<main>

    <!-- PROJECTS -->
    <section aria-labelledby="projects-title" class="max-w-6xl mx-auto px-6 py-20">

        <!-- Header -->
        <header class="mb-12">
            <h2 id="projects-title" class="text-2xl font-semibold mb-2">
                Projects Lab
            </h2>

            <p class="text-gray-600">
                A selection of projects showcasing ideas, experiments, and work in progress.
            </p>
        </header>

        <!-- Grid -->
        <ul class="flex gap-6 overflow-x-auto pb-6 px-2 md:px-0">
            @forelse($projects as $project)
                <li class="flex-shrink-0">
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



    </section>

</main>

@endsection
