@props([
	'card' => false,
	'head' => null,
	'foot' => null,
	'before' => null,
	'after' => null,
])

<div {{ $attributes->class([
	'rounded-lg border border-gray-200' => $card
]) }}>
    @if($before)
        {{ $before }}
    @endif
    <table class="w-full">
        @if($head)
            <thead>{{ $head }}</thead>
        @endif
        <tbody>{{ $body }}</tbody>
        @if($foot)
            <tfoot>{{ $foot }}</tfoot>
        @endif
    </table>
    @if($after)
        {{ $after }}
    @endif
</div>