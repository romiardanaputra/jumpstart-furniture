@props([
    'id',
    'title' => '',
    'size' => 'md',
])

@php
$sizes = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-lg',
    'lg' => 'max-w-2xl',
    'xl' => 'max-w-4xl',
    'full' => 'max-w-full mx-4',
];
$sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div
    x-data="{ open: false }"
    x-show="open"
    x-on:open-modal-{{ $id }}.window="open = true"
    x-on:close-modal-{{ $id }}.window="open = false"
    x-on:keydown.escape.window="open = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
    {{ $attributes }}
>
    {{-- Backdrop --}}
    <div 
        class="fixed inset-0 bg-black/50 transition-opacity"
        x-on:click="open = false"
    ></div>

    {{-- Modal --}}
    <div class="flex min-h-full items-center justify-center p-4">
        <div
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative w-full {{ $sizeClass }} bg-white dark:bg-gray-800 rounded-lg shadow-xl"
            x-on:click.stop
        >
            {{-- Header --}}
            @if($title)
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $title }}
                    </h3>
                    <button
                        type="button"
                        x-on:click="open = false"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Content --}}
            <div class="p-4">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            @isset($footer)
                <div class="flex items-center justify-end gap-2 p-4 border-t dark:border-gray-700">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
