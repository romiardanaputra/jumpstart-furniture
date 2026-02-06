@props([
    'name',
    'label',
    'options' => [],
    'selected' => '',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'placeholder' => 'Select an option',
])

@php
$hasError = $error || $errors->has($name);
$errorMessage = $error ?? $errors->first($name);

$selectClasses = 'block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer cursor-pointer';
$errorSelectClasses = 'border-red-600 focus:border-red-600';

$labelClasses = 'absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 left-1';
$errorLabelClasses = 'text-red-600 peer-focus:text-red-600';
@endphp

<div class="w-full">
    <div class="relative w-full">
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => $selectClasses . ($hasError ? ' ' . $errorSelectClasses : '')]) }}
        >
            <option value="" disabled {{ !$selected ? 'selected' : '' }}>{{ $placeholder }}</option>
            @foreach($options as $value => $text)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>
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
