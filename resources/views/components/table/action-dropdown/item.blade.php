@props([
	'link' => false
])

@php
    $tag = $link ? 'a' : 'button';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => 'cursor-pointer w-full block py-1 px-4 text-xs text-left text-gray-500 font-semibold hover:text-gray-800 hover:bg-gray-100 transition-colors']) }}>
    {{ $slot }}
</{{ $tag }}>