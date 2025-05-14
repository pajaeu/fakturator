<div>
    <x-header>
        <x-slot:title>{{ __('New contact') }}</x-slot:title>
    </x-header>
    <x-card>
        <div class="mx-auto max-w-3xl">
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Company name / Full name') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="name"/>
                    <x-form.input-error name="name"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Company ID') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="company_id"/>
                    <x-form.input-error name="company_id"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('VAT ID') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="vat_id"/>
                    <x-form.input-error name="vat_id"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Email') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="email"/>
                    <x-form.input-error name="email"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Phone') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="phone"/>
                    <x-form.input-error name="phone"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Address') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="address"/>
                    <x-form.input-error name="address"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('City') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="city"/>
                    <x-form.input-error name="city"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('ZIP') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="zip"/>
                    <x-form.input-error name="zip"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Country') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="country"/>
                    <x-form.input-error name="country"/>
                </div>
            </div>
        </div>
    </x-card>
    <div class="mt-5 md:flex md:justify-end">
        <button wire:click="save" class="cursor-pointer py-3 px-4 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Create contact') }}</button>
    </div>
</div>
