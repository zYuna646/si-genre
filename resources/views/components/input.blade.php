@props([
    'type' => 'text',
    'name',
    'id' => null,
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'error' => null,
    'label' => null,
    'icon' => null
])

@php
    $id = $id ?? $name;
    $classes = 'w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 transition-colors duration-200';
    
    if ($error) {
        $classes .= ' border-old-brick-500 focus:ring-old-brick-200 focus:border-old-brick-600';
    } else {
        $classes .= ' border-gray-300 focus:ring-elephant-200 focus:border-elephant-500';
    }
    
    if ($disabled) {
        $classes .= ' bg-gray-100 cursor-not-allowed';
    } else {
        $classes .= ' bg-white';
    }
@endphp

<div class="space-y-1">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
            @if($required)
                <span class="text-danger-500">*</span>
            @endif
        </label>
    @endif
    
    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $icon !!}
                </svg>
            </div>
        @endif
        
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="{{ $classes }} {{ $icon ? 'pl-10' : '' }}"
            {{ $attributes }}
        />
    </div>
    
    @if($error)
        <p class="text-sm text-old-brick-600 bg-old-brick-50 p-2 rounded border-l-4 border-old-brick-500">{{ $error }}</p>
    @endif
    
    @error($name)
        <p class="text-sm text-old-brick-600 bg-old-brick-50 p-2 rounded border-l-4 border-old-brick-500">{{ $message }}</p>
    @enderror
</div>