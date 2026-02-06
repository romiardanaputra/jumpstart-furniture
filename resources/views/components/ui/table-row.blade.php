@props([
    'hover' => true,
])

<tr {{ $attributes->merge(['class' => 'bg-white border-b dark:bg-gray-800 dark:border-gray-700' . ($hover ? ' hover:bg-gray-50 dark:hover:bg-gray-700' : '')]) }}>
    {{ $slot }}
</tr>
