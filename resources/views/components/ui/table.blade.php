@props([
    'striped' => false,
    'hoverable' => true,
])

@php
$tableClasses = 'w-full text-sm text-left text-gray-500 dark:text-gray-400';
@endphp

<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <table {{ $attributes->merge(['class' => $tableClasses]) }}>
        @isset($head)
            <thead class="text-xs text-white uppercase bg-[#f4841a] dark:bg-gray-700 dark:text-gray-400">
                {{ $head }}
            </thead>
        @endisset

        <tbody>
            {{ $slot }}
        </tbody>

        @isset($foot)
            <tfoot class="bg-gray-50 dark:bg-gray-800">
                {{ $foot }}
            </tfoot>
        @endisset
    </table>
</div>

{{-- Table Row Component --}}
@once
@push('components')
{{-- This is a hint for developers to use <x-ui.table.row> --}}
@endpush
@endonce
