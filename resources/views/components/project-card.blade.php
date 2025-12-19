@props(['title', 'description', 'link'])

<div class="border rounded-xl p-6 hover:shadow-md transition">
    <h3 class="text-lg font-semibold text-gray-900">
        {{ $title }}
    </h3>

    <p class="mt-2 text-sm text-gray-600">
        {{ $description }}
    </p>

    <a href="{{ $link }}"
        class="inline-block mt-4 text-sm font-medium text-blue-600 hover:underline">
        View project →
    </a>
</div>
