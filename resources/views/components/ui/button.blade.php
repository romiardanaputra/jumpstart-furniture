@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'loading' => false,
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium transition duration-300 ease-in-out focus:outline-none focus:ring-4 disabled:opacity-50 disabled:cursor-not-allowed';

$variants = [
    'primary' => 'text-white bg-[#F4841A] hover:bg-gray-900 focus:ring-gray-300',
    'secondary' => 'text-gray-900 bg-gray-200 hover:bg-gray-300 focus:ring-gray-300',
    'outline' => 'text-[#F4841A] border-2 border-[#F4841A] bg-transparent hover:bg-[#F4841A] hover:text-white focus:ring-orange-300',
    'ghost' => 'text-gray-600 bg-transparent hover:bg-gray-100 focus:ring-gray-200',
    'destructive' => 'text-white bg-red-600 hover:bg-red-700 focus:ring-red-300',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-xs',
    'md' => 'px-[2rem] py-2.5 text-sm',
    'lg' => 'px-[3rem] py-3 text-sm',
];

$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

<button
    type="{{ $type }}"
    {{ $disabled || $loading ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => $classes]) }}
>
    @if($loading)
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @endif
    {{ $slot }}
</button>
