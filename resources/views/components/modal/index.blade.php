<div x-data="{ show: false }">
    {{ $slot }}
    <div {{ $attributes->merge(['class' => 'fixed left-0 top-0 w-screen h-screen flex justify-center items-center bg-gray-800/30']) }} x-show="show" x-cloak>
        <div {{ $body->attributes->merge(['class' => 'w-full mx-4 md:mx-0 max-w-4xl max-h-[95vh] overflow-y-auto rounded-lg p-5 border border-gray-200 bg-white shadow']) }} @click.outside.window="show = false" x-show="show" x-transition>
            {{ $body }}
        </div>
    </div>
</div>