@props([
    'name',
    'label' => null,
    'type' => 'text',
    'error' => null,
    'required' => false,
])

@php
$hasError = $error || $errors->has($name);
$errorMessage = $error ?? $errors->first($name);
@endphp

<div class="grid w-full items-center gap-1.5">
    @if($label)
        <label for="{{ $name }}" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50' . ($hasError ? ' border-red-500' : '')]) }}
    />
    @if($hasError)
        <p class="text-sm font-medium text-red-500">{{ $errorMessage }}</p>
    @endif
</div>
