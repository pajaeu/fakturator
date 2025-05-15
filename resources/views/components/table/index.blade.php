@props([
	'card' => false,
	'foot' => null
])

<div {{ $attributes->class([
	'pb-5 rounded-lg border border-gray-200' => $card
]) }}>
    <table class="w-full">
        <thead>{{ $head }}</thead>
        <tbody>{{ $body }}</tbody>
        @if($foot)
            <tfoot>{{ $foot }}</tfoot>
        @endif
    </table>
</div>