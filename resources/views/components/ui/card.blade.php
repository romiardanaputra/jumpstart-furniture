@props([
    'padding' => 'p-6',
    'shadow' => 'shadow-md',
])

<div {{ $attributes->merge(['class' => "bg-white dark:bg-gray-800 rounded-lg {$shadow} {$padding}"]) }}>
    @isset($header)
        <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
            {{ $header }}
        </div>
    @endisset

    <div>
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
            {{ $footer }}
        </div>
    @endisset
</div>
