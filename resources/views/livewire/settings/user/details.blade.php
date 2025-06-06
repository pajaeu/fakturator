@section('title', __('User details'))

<div>
    <x-header>
        <x-slot:title>{{ __('User details') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('settings.index') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.arrow-back class="size-4"/>
                <span>{{ __('Back') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <x-card class="mb-6">
        <div class="mx-auto max-w-3xl">
            <div class="flex flex-col md:flex-row gap-2 md:gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Email') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="email" @class(['border-red-500' => $errors->has('email')])/>
                    <x-form.input-error name="email"/>
                </div>
            </div>
        </div>
    </x-card>
    <div class="md:flex md:justify-end">
        <button wire:click="save" class="cursor-pointer py-3 px-6 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Save') }}</button>
    </div>
    <x-card class="md:p-10">
        <h2 class="text-lg font-semibold mb-1">{{ __('Delete account') }}</h2>
        <p class="text-gray-500 mb-6">{{ __('Delete your account and all of its resources.') }}</p>
        <div class="rounded-md p-5 border border-red-200 text-red-600 bg-red-50">
            <p class="mb-4">{{ __('This action cannot be undone.') }}</p>
            <x-button wire:click="delete" wire:confirm="{{ __('Are you really sure you want to delete your account?') }}" variant="danger">
                {{ __('Confirm and delete account') }}
            </x-button>
        </div>
    </x-card>
</div>
