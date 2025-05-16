@props([
	'card' => false,
	'head' => null,
	'foot' => null,
])

<div {{ $attributes->class([
	'rounded-lg border border-gray-200' => $card
]) }}>
    <table class="w-full">
        @if($head)
            <thead>{{ $head }}</thead>
        @endif
        <tbody>{{ $body }}</tbody>
        @if($foot)
            <tfoot>{{ $foot }}</tfoot>
        @endif
    </table>
</div>