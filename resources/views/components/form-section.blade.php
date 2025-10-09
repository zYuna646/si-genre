@props(['title', 'description' => null, 'submit'])

<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        @if($title)
        <div class="mb-6">
            <h3 class="text-lg font-medium text-elephant-900">{{ $title }}</h3>
            
            @if($description)
            <p class="mt-1 text-sm text-gray-600">{{ $description }}</p>
            @endif
        </div>
        @endif

        <form action="{{ $submit }}" method="POST" {{ $attributes }}>
            @csrf
            
            <div class="space-y-6">
                {{ $slot }}
            </div>

            @if(isset($actions))
            <div class="flex items-center justify-end mt-6 space-x-3">
                {{ $actions }}
            </div>
            @endif
        </form>
    </div>
</div>