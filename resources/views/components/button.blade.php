@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'loading' => false,
    'href' => null,
    'icon' => null,
    'iconPosition' => 'left'
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';
    
    // Size classes
    $sizeClasses = [
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-3 text-base',
        'lg' => 'px-6 py-4 text-lg'
    ];
    
    // Variant classes
    $variantClasses = [
        'primary' => 'bg-elephant-600 hover:bg-elephant-700 text-white focus:ring-elephant-200 shadow-sm',
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-800 focus:ring-gray-200 shadow-sm',
        'success' => 'bg-forest-green-600 hover:bg-forest-green-700 text-white focus:ring-forest-green-200 shadow-sm',
        'danger' => 'bg-old-brick-600 hover:bg-old-brick-700 text-white focus:ring-old-brick-200 shadow-sm',
        'outline-primary' => 'border-2 border-elephant-600 text-elephant-600 hover:bg-elephant-50 focus:ring-elephant-200',
        'outline-secondary' => 'border-2 border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-gray-200',
        'ghost' => 'text-elephant-600 hover:bg-elephant-50 focus:ring-elephant-200'
    ];
    
    $classes = $baseClasses . ' ' . $sizeClasses[$size] . ' ' . $variantClasses[$variant];
    
    if ($disabled || $loading) {
        $classes .= ' opacity-50 cursor-not-allowed';
    }
@endphp

@if($href && !$disabled && !$loading)
    <a href="{{ $href }}" class="{{ $classes }}" {{ $attributes }}>
        @if($icon && $iconPosition === 'left')
            <svg class="w-5 h-5 {{ $slot->isNotEmpty() ? 'mr-2' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icon !!}
            </svg>
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right')
            <svg class="w-5 h-5 {{ $slot->isNotEmpty() ? 'ml-2' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icon !!}
            </svg>
        @endif
    </a>
@else
    <button
        type="{{ $type }}"
        class="{{ $classes }}"
        {{ $disabled || $loading ? 'disabled' : '' }}
        {{ $attributes }}
    >
        @if($loading)
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading...
        @else
            @if($icon && $iconPosition === 'left')
                <svg class="w-5 h-5 {{ $slot->isNotEmpty() ? 'mr-2' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $icon !!}
                </svg>
            @endif
            
            {{ $slot }}
            
            @if($icon && $iconPosition === 'right')
                <svg class="w-5 h-5 {{ $slot->isNotEmpty() ? 'ml-2' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $icon !!}
                </svg>
            @endif
        @endif
    </button>
@endif