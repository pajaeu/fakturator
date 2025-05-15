<div>
    <x-header>
        <x-slot:title>{{ __('Issue invoice') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('invoices.index') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.arrow-back class="size-4"/>
                <span>{{ __('Back') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <x-card>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10 lg:gap-20">
            <div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/3">{{ __('Customer') }}</label>
                    <div class="w-full">
                        <x-form.input wire:model.blur="contact_id" @class(['border-red-500' => $errors->has('contact_id')])/>
                        <x-form.input-error name="contact_id"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/3">{{ __('Number') }}</label>
                    <div class="w-full">
                        <x-form.input wire:model.blur="number" @class(['border-red-500' => $errors->has('number')])/>
                        <x-form.input-error name="number"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/3">{{ __('Variable symbol') }}</label>
                    <div class="w-full">
                        <x-form.input wire:model.blur="variable_symbol" @class(['border-red-500' => $errors->has('variable_symbol')])/>
                        <x-form.input-error name="variable_symbol"/>
                    </div>
                </div>
            </div>
            <div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/3">{{ __('Date of issue') }}</label>
                    <div class="w-full">
                        <div x-data="{}" x-init="flatpickr($refs.input, { format: 'Y-m-d', minDate: '{{ now()->toDateString() }}'})">
                            <x-form.input x-ref="input" wire:model.blur="issued_at" @class(['border-red-500' => $errors->has('issued_at')])/>
                        </div>
                        <x-form.input-error name="issued_at"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/3">{{ __('Due date') }}</label>
                    <div class="w-full">
                        <div x-data="{}" x-init="flatpickr($refs.input, { format: 'Y-m-d', minDate: '{{ now()->toDateString() }}'})">
                            <x-form.input x-ref="input" wire:model.blur="due_at" @class(['border-red-500' => $errors->has('due_at')])/>
                        </div>
                        <x-form.input-error name="due_at"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/3"></label>
                    <div class="w-full">

                    </div>
                </div>
            </div>
        </div>
    </x-card>
    <div class="py-4">
        <h2 class="text-2xl font-medium">{{ __('Invoice items') }}</h2>
    </div>
    @include('partials.invoice.items')
    <div class="mt-5 md:flex md:justify-end">
        <button wire:click="save" class="cursor-pointer py-3 px-4 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Issue invoice') }}</button>
    </div>
</div>
