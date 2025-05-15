@props([
	'buttons' => null
])

<div class="flex items-center mb-6">
    <h1 class="text-3xl font-medium">{{ $title }}</h1>
    @if($buttons)
        <div class="ms-auto flex items-center gap-2">
            {{ $buttons }}
        </div>
    @endif
</div>