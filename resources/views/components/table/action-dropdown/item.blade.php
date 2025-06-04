@props([
	'link' => false
])

@php
    $tag = $link ? 'a' : 'button';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => 'cursor-pointer w-full text-sm flex gap-3 items-center py-2 px-3 rounded hover:bg-gray-100 transition-colors']) }}>
    {{ $slot }}
</{{ $tag }}>