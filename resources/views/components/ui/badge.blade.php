@props([
    'variant' => 'default',
    'size' => 'md',
])

@php
$variants = [
    'default' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
    'primary' => 'bg-[#F4841A]/10 text-[#F4841A]',
    'success' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
    'warning' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
    'error' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
    'info' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
];

$sizes = [
    'sm' => 'text-xs px-2 py-0.5',
    'md' => 'text-xs px-2.5 py-0.5',
    'lg' => 'text-sm px-3 py-1',
];

$variantClass = $variants[$variant] ?? $variants['default'];
$sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center font-medium rounded-full {$variantClass} {$sizeClass}"]) }}>
    {{ $slot }}
</span>
