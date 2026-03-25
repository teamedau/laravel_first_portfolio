@extends('layouts.app')

@section('content')
<section class="section-dark">
    <div class="container" style="max-width: 760px;">
        <h1 style="font-size: clamp(2rem, 5vw, 4rem); margin-bottom: 24px;">Sobre Vica Projects</h1>

        <p style="font-size: 1.1rem; line-height: 1.9; margin-bottom: 24px;">
            Vica Projects es un espacio para explorar ideas, construir en público y conectar con personas que quieren probar proyectos antes de que sean un producto terminado.
        </p>

        <p style="line-height: 1.9; margin-bottom: 24px;">
            La idea es simple: publicar proyectos reales en sus distintas etapas —concept, MVP, live— y que la comunidad pueda seguirlos, votarlos y registrarse como testers o early adopters.
        </p>

        <p style="line-height: 1.9; margin-bottom: 40px;">
            Si un proyecto te interesa, únete. Tu feedback temprano es lo que transforma una idea en algo que realmente vale la pena.
        </p>

        <a href="{{ route('projects.index') }}" class="btn-primary">Ver proyectos</a>
    </div>
</section>
@endsection
