@section('title', __('Edit folder'))

<div>
    <x-header>
        <x-slot:title>{{ __('Edit folder') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('folders.index') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.arrow-back class="size-4"/>
                <span>{{ __('Back') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <x-card>
        <div class="mx-auto max-w-3xl">
            <div class="flex flex-col md:flex-row gap-2 md:gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Name') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="name" @class(['border-red-500' => $errors->has('name')])/>
                    <x-form.input-error name="name"/>
                </div>
            </div>
        </div>
    </x-card>
    <div class="mt-5 md:flex md:justify-end">
        <button wire:click="save" class="cursor-pointer py-3 px-6 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Edit folder') }}</button>
    </div>
</div>
