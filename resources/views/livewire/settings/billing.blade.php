@section('title', __('Billing settings'))

<div>
    <x-header>
        <x-slot:title>{{ __('Billing settings') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('settings.index') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.arrow-back class="size-4"/>
                <span>{{ __('Back') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <x-card>
        <div class="mx-auto max-w-3xl">
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Company name / Full name') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="billing_company" @class(['border-red-500' => $errors->has('billing_company')])/>
                    <x-form.input-error name="billing_company"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Company ID') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.live.debounce.250ms="company_id" @class(['border-red-500' => $errors->has('company_id')])/>
                    <x-form.input-error name="company_id"/>
                    <div class="py-2 text-sm text-gray-500">{{ __('Enter the company ID, other data will be automatically filled in from the ARES database') }}</div>
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
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Address') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="billing_address" @class(['border-red-500' => $errors->has('billing_address')])/>
                    <x-form.input-error name="billing_address"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('City') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="billing_city" @class(['border-red-500' => $errors->has('billing_city')])/>
                    <x-form.input-error name="billing_city"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('ZIP') }}</label>
                <div class="w-full">
                    <x-form.input wire:model.blur="billing_zip" @class(['border-red-500' => $errors->has('billing_zip')])/>
                    <x-form.input-error name="billing_zip"/>
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <label class="w-full md:pt-2 md:w-1/2 md:text-end">{{ __('Country') }}</label>
                <div class="w-full">
                    <x-form.country-select wire:model.blur="billing_country" @class(['border-red-500' => $errors->has('billing_country')])/>
                    <x-form.input-error name="billing_country"/>
                </div>
            </div>
        </div>
    </x-card>
    <div class="mt-5 md:flex md:justify-end">
        <button wire:click="save" class="cursor-pointer py-3 px-6 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Save') }}</button>
    </div>
</div>
