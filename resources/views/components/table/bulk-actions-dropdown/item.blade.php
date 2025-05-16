@props([
	'link' => false
])

@php
    $tag = $link ? 'a' : 'button';
@endphp

<{{ $tag }} @click="show = false" {{ $attributes->merge(['class' => 'cursor-pointer w-full flex gap-4 items-center py-2 px-4 text-sm text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition-colors']) }}>
    {{ $slot }}
</{{ $tag }}>