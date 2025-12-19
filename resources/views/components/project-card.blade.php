@props(['title', 'description', 'link', 'image', 'content', 'progress'])

<div class="border rounded-2xl overflow-hidden bg-white hover:shadow-lg transition-shadow duration-300">

    <!-- Image -->
    <div class="h-48 w-full overflow-hidden">
        <img
            src="https://via.placeholder.com/400x300"
            alt="{{ $title }}"
            class="h-full w-full object-cover"
        />
    </div>

    <!-- Content -->
    <div class="p-6">

        <div class="flex justify-between gap-6">
            
            <!-- Left: Title & description -->
            <div class="flex-1">
                <h3 class="font-title text-2xl uppercase tracking-wide text-gray-900">
                    {{ $title }}
                </h3>

                <p class="mt-2 font-body text-sm text-gray-600 leading-relaxed">
                    {{ $description }}
                </p>
            </div>

            <!-- Right: List -->
            <ul class="text-sm text-gray-700 space-y-2 min-w-[80px]">
                <li class="h-2 w-6 bg-gray-300 rounded"></li>
                <li class="h-2 w-6 bg-gray-300 rounded"></li>
                <li class="h-2 w-6 bg-gray-300 rounded"></li>
                <li class="h-2 w-6 bg-gray-300 rounded"></li>
            </ul>

        </div>

        <!-- Progress bar -->
        <div class="mt-6">
            <div class="flex justify-between mb-1">
                <span class="text-xs text-gray-500">Progress</span>
                <span class="text-xs font-medium text-gray-700">70%</span>
            </div>

            <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                <div 
                    class="h-full bg-black rounded-full"
                    style="width: 70%;"
                ></div>
            </div>
        </div>

    </div>
</div>

