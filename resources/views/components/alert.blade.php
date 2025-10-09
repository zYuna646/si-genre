@props([
    'type' => 'info',
    'dismissible' => false,
    'icon' => true
])

@php
    $baseClasses = 'p-4 rounded-lg border';
    
    $typeClasses = [
        'success' => 'bg-success-50 border-success-200 text-success-800',
        'danger' => 'bg-danger-50 border-danger-200 text-danger-800',
        'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
        'info' => 'bg-blue-50 border-blue-200 text-blue-800'
    ];
    
    $iconPaths = [
        'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'danger' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>',
        'warning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>',
        'info' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
    ];
    
    $classes = $baseClasses . ' ' . $typeClasses[$type];
@endphp

<div class="{{ $classes }}" {{ $attributes }} @if($dismissible) x-data="{ show: true }" x-show="show" @endif>
    <div class="flex">
        @if($icon)
            <div class="flex-shrink-0">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $iconPaths[$type] !!}
                </svg>
            </div>
        @endif
        
        <div class="{{ $icon ? 'ml-3' : '' }} flex-1">
            {{ $slot }}
        </div>
        
        @if($dismissible)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button @click="show = false" type="button" class="inline-flex rounded-md p-1.5 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>