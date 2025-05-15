@props([
	'link' => false
])

@php
    $tag = $link ? 'a' : 'button';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => 'cursor-pointer w-full block py-1 px-4 text-xs text-left text-gray-600 font-semibold hover:bg-gray-50 transition-colors']) }}>
    {{ $slot }}
</{{ $tag }}>