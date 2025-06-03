<div>
    <x-header>
        <x-slot:title>{{ __('New contact') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('contacts.index') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.arrow-back class="size-4"/>
                <span>{{ __('Back') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <x-card>
        <div x-data="{ show: $wire.entangle('otherDataFilled') }" class="mx-auto max-w-3xl">
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Company ID') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.live.debounce.250ms="company_id" @class(['border-red-500' => $errors->has('company_id')])/>
                    <x-form.input-error name="company_id"/>
                    <div class="py-2 text-sm text-gray-500">{{ __('Enter the company ID, other data will be automatically filled in from the ARES database') }}</div>
                    <button @click="show = true" x-show="!show" class="mt-2 cursor-pointer inline-flex items-center gap-2 text-gray-500 hover:text-gray-800 transition-colors">
                        <x-icons.pencil class="size-5"/>
                        <span>{{ __('Enter other data manually') }}</span>
                    </button>
                </div>
            </div>
            <div x-show="show" x-cloak>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Company name / Full name') }}</label>
                    <div class="w-full">
                        <x-form.input wire:model.blur="name" @class(['border-red-500' => $errors->has('name')])/>
                        <x-form.input-error name="name"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('VAT ID') }}</label>
                    <div class="w-full">
                        <x-form.input wire:model.blur="vat_id" @class(['border-red-500' => $errors->has('vat_id')])/>
                        <x-form.input-error name="vat_id"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Email') }}</label>
                    <div class="w-full">
                        <x-form.input wire:model.blur="email" @class(['border-red-500' => $errors->has('email')])/>
                        <x-form.input-error name="email"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Phone') }}</label>
                    <div class="w-full">
                        <x-form.input wire:model.blur="phone" @class(['border-red-500' => $errors->has('phone')])/>
                        <x-form.input-error name="phone"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Address') }}</label>
                    <div class="w-full">
                        <x-form.input wire:model.blur="address" @class(['border-red-500' => $errors->has('address')])/>
                        <x-form.input-error name="address"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('City') }}</label>
                    <div class="w-full">
                        <x-form.input wire:model.blur="city" @class(['border-red-500' => $errors->has('city')])/>
                        <x-form.input-error name="city"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('ZIP') }}</label>
                    <div class="w-full">
                        <x-form.input wire:model.blur="zip" @class(['border-red-500' => $errors->has('zip')])/>
                        <x-form.input-error name="zip"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Country') }}</label>
                    <div class="w-full">
                        <x-form.country-select wire:model.blur="country" @class(['border-red-500' => $errors->has('country')])/>
                        <x-form.input-error name="country"/>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
    <div class="mt-5 md:flex md:justify-end">
        <button wire:click="save" class="cursor-pointer py-3 px-6 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Create contact') }}</button>
    </div>
</div>
