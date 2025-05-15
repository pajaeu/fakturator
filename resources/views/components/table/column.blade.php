@props([
	'align' => 'left'
])

<td {{ $attributes->class([
	'p-2 first:ps-5 last:pe-5',
	'text-left' => $align === 'left',
	'text-right' => $align === 'right',
	'text-center' => $align === 'center',
]) }}>
    {{ $slot }}
</td>