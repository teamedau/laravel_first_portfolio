@props([ 
    'title',
    'description',
    'image' => null,
    'progress' => 70,
    'tech' => [],          
    'status' => null      
])

<div class="project-card">

    <div class="project-image">
        <img src="{{ $image ?? 'https://via.placeholder.com/400x300' }}" alt="{{ $title }}">
    </div>

    <div class="project-content">

        <div class="project-header">
            <div>
                <h3 class="project-title">{{ $title }}</h3>
                <p class="project-description">{{ $description }}</p>
            </div>

            <ul class="project-markers">
                <!-- Mostrar tecnologías -->
                @foreach($tech as $t)
                    <li>{{ $t }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Mostrar status si existe -->
        @if($status)
            <div class="project-status">
                <span>Status: {{ $status }}</span>
            </div>
        @endif

        <div class="project-progress">
            <div class="project-progress-meta">
                <span>Progress</span>
                <span>{{ $progress }}%</span>
            </div>

            <div class="project-progress-bar">
                <span style="width: {{ $progress }}%"></span>
            </div>
        </div>

    </div>
</div>
