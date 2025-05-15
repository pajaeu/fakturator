@props([
	'variant' => 'primary',
	'link' => false
])

@php
    $tag = $link ? 'a' : 'button';
@endphp

<{{ $tag }} {{ $attributes->class([
	'cursor-pointer flex items-center gap-2 py-2 px-4 rounded-full text-sm font-medium border transition-colors',
	'text-white border-blue-600 bg-blue-600 hover:border-blue-700 hover:bg-blue-700' => $variant === 'primary',
	'text-blue-600 border-blue-600 hover:text-white hover:bg-blue-600' => $variant === 'outline',
]) }}>
    {{ $slot }}
</{{ $tag }}>