@props([
    'variant' => 'default',
])

@php
$variants = [
    'default' => 'border-transparent bg-primary text-primary-foreground hover:bg-primary/80',
    'primary' => 'border-transparent bg-primary text-primary-foreground hover:bg-primary/80', // Tambahkan ini
    'secondary' => 'border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80',
    'outline' => 'text-foreground',
    'destructive' => 'border-transparent bg-red-500 text-slate-50 hover:bg-red-500/80',
];
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 ' . $variants[$variant]]) }}>
    {{ $slot }}
</div>
