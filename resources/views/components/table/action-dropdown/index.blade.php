<div class="relative" x-data="{ show: false }">
    <button @click="show = !show" class="cursor-pointer py-1 px-2 text-gray-600 rounded-full border border-transparent hover:text-gray-800 hover:border-gray-800 transition-colors">
        <x-icons.dots class="size-5"/>
    </button>
    <div class="absolute top-full right-0 z-10 py-2 rounded-lg w-max min-w-[100px] border border-gray-200 bg-white" x-show="show" x-cloak @click.outside.window="show = false">
        {{ $items }}
    </div>
</div>