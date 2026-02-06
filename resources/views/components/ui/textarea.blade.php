@props([
    'name',
    'label',
    'rows' => 4,
    'value' => '',
    'error' => null,
    'required' => false,
    'disabled' => false,
])

@php
$hasError = $error || $errors->has($name);
$errorMessage = $error ?? $errors->first($name);

$inputClasses = 'block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer resize-none';
$errorInputClasses = 'border-red-600 focus:border-red-600';

$labelClasses = 'absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-6 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1';
$errorLabelClasses = 'text-red-600 peer-focus:text-red-600';
@endphp

<div class="w-full">
    <div class="relative w-full">
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            rows="{{ $rows }}"
            placeholder=" "
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => $inputClasses . ($hasError ? ' ' . $errorInputClasses : '')]) }}
        >{{ $value }}</textarea>
        <label
            for="{{ $name }}"
            class="{{ $labelClasses }} {{ $hasError ? $errorLabelClasses : '' }}"
        >
            {{ $label }}{{ $required ? ' *' : '' }}
        </label>
    </div>
    @if($hasError)
        <p class="mt-2 text-xs text-red-600 dark:text-red-400">
            <span class="font-medium">Oh, snap!</span> {{ $errorMessage }}
        </p>
    @endif
</div>
