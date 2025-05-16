@props([
	'label' => null
])

<label class="flex items-center group cursor-pointer">
    <input type="checkbox" {{ $attributes }} class="hidden peer"/>
    <span class="shrink-0 size-5 flex items-center justify-center border-1 border-gray-200 group-hover:border-gray-400
         text-white
         peer-checked:bg-blue-600
         peer-checked:border-blue-600
         rounded transition-all">
        <x-icons.check class="size-5"/>
    </span>
    @if($label)
        <span class="ml-2 text-gray-700">{{ $label }}</span>
    @endif
</label>