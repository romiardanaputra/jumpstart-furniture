@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#f4841a]  focus:ring-[#f4841a] focus:ring-opacity-50']) !!}>
