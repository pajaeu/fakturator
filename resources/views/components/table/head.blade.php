@props([
	'align' => 'left'
])

<th {{ $attributes->class([
	'py-3 px-2 first:ps-5 last:pe-5 font-normal text-sm text-gray-500',
	'border-b border-gray-200',
	'text-left' => $align === 'left',
	'text-right' => $align === 'right',
	'text-center' => $align === 'center',
]) }}>
    {{ $slot }}
</th>