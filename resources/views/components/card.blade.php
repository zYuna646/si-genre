@props([
    'padding' => 'default',
    'shadow' => 'default',
    'rounded' => 'default',
    'header' => null,
    'footer' => null
])

@php
    $baseClasses = 'bg-white border border-gray-200';
    
    // Padding classes
    $paddingClasses = [
        'none' => '',
        'sm' => 'p-4',
        'default' => 'p-6',
        'lg' => 'p-8'
    ];
    
    // Shadow classes
    $shadowClasses = [
        'none' => '',
        'sm' => 'shadow-sm',
        'default' => 'shadow-md',
        'lg' => 'shadow-lg',
        'xl' => 'shadow-xl'
    ];
    
    // Rounded classes
    $roundedClasses = [
        'none' => '',
        'sm' => 'rounded-sm',
        'default' => 'rounded-lg',
        'lg' => 'rounded-xl',
        'full' => 'rounded-full'
    ];
    
    $classes = $baseClasses . ' ' . $shadowClasses[$shadow] . ' ' . $roundedClasses[$rounded];
@endphp

<div class="{{ $classes }}" {{ $attributes }}>
    @if($header)
        <div class="border-b border-gray-200 {{ $paddingClasses[$padding] }} pb-4 mb-4">
            {{ $header }}
        </div>
    @endif
    
    <div class="{{ $header || $footer ? '' : $paddingClasses[$padding] }}">
        {{ $slot }}
    </div>
    
    @if($footer)
        <div class="border-t border-gray-200 {{ $paddingClasses[$padding] }} pt-4 mt-4">
            {{ $footer }}
        </div>
    @endif
</div>