@extends('layouts.app')

@section('content')
<section class="section-dark">
    <div class="container" style="max-width: 760px;">
        <h1 style="font-size: clamp(2rem, 5vw, 4rem); margin-bottom: 24px;">About Vica Projects</h1>

        <p style="font-size: 1.1rem; line-height: 1.9; margin-bottom: 24px;">
            Vica Projects is a space to explore ideas, build in public, and connect with people who want to try things out before they become a finished product.
        </p>

        <p style="line-height: 1.9; margin-bottom: 24px;">
            The idea is straightforward: share real projects at every stage — concept, MVP, live — and let the community follow along, vote, and sign up as testers or early adopters.
        </p>

        <p style="line-height: 1.9; margin-bottom: 40px;">
            If a project catches your eye, get involved. Early feedback is what turns a rough idea into something genuinely worth building.
        </p>

        <a href="{{ route('projects.index') }}" class="btn-primary">Browse projects</a>
    </div>
</section>
@endsection
