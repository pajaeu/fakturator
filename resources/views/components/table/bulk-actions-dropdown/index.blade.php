<div x-data="{ show: false }" {{ $attributes->merge(['class' => 'relative']) }}>
    <button @click="show = !show" class="cursor-pointer py-2 px-4 flex items-center gap-2 text-sm text-gray-500 rounded-lg border transition-all" :class="show ? 'text-gray-800 border-blue-600' : 'border-gray-200 hover:text-gray-800 hover:border-gray-300'">
        <span>{{ __('Bulk actions') }}</span>
        <x-icons.chevron-down class="size-5 transition-transform" x-bind:class="show ? 'rotate-180' : ''"/>
    </button>
    <div class="absolute full-0 left-0 z-10 py-2 rounded-lg w-max min-w-[200px] shadow-md bg-white" x-show="show" x-cloak @click.outside.window="show = false">
        {{ $items }}
    </div>
</div>