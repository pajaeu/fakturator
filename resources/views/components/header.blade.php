@props([
	'head' => null,
	'buttons' => null
])

<div class="flex md:items-center mb-6">
    <div>
        <h1 @class(['text-2xl md:text-3xl font-medium', 'mb-2' => $head])>{{ $title }}</h1>
        @if($head)
            {{ $head }}
        @endif
    </div>
    @if($buttons)
        <div class="ms-auto flex flex-col md:flex-row items-end md:items-center gap-2">
            {{ $buttons }}
        </div>
    @endif
</div>