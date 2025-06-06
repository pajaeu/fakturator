@section('title', __('Change your password'))

<div>
    <x-header>
        <x-slot:title>{{ __('Change your password') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('settings.index') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.arrow-back class="size-4"/>
                <span>{{ __('Back') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <x-card class="mb-6">
        <div class="mx-auto max-w-3xl">
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Password') }}</label>
                <div class="w-full">
                    <x-form.input type="password" wire:model.blur="password" @class(['border-red-500' => $errors->has('password')]) autocomplete="off"/>
                    <x-form.input-error name="password"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Confirm password') }}</label>
                <div class="w-full">
                    <x-form.input type="password" wire:model.blur="password_confirmation" @class(['border-red-500' => $errors->has('password_confirmation')]) autocomplete="off"/>
                    <x-form.input-error name="password_confirmation"/>
                </div>
            </div>
        </div>
    </x-card>
    <div class="mt-5 md:flex md:justify-end">
        <button wire:click="save" class="cursor-pointer py-3 px-6 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Save') }}</button>
    </div>
</div>
