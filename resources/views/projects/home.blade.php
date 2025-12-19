@extends('layouts.app')

@section('content')
<main>

    <section aria-labelledby="projects-title">

        <header>
            <h1 id="projects-title">
                Projects
            </h1>

            <p>
                A selection of projects showcasing ideas, experiments, and work in progress.
            </p>
        </header>

        <ul>
            <li>
                <x-project-card
                    title="Project Title"
                    description="Idea 1. Clear, short, and human."
                    link="#"
                />
            </li>

            <li>
                <x-project-card
                    title="Another Project"
                    description="Idea 2. Crazy but may work."
                    link="#"
                />
            </li>
        </ul>

    </section>

</main>
@endsection
