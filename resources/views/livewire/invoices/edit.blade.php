@section('title', __('Edit invoice'))

<div>
    <x-header>
        <x-slot:title>{{ __('Edit invoice') }}  #{{ $invoice->number }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('invoices.index') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.arrow-back class="size-4"/>
                <span>{{ __('Back') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <x-card class="mb-5" x-data="{ show: false  }">
        <div class="flex items-center" x-show="!show">
            <div>
                Odběratel:
                <span class="text-lg font-medium">{{ $customer_company }}</span>
            </div>
            <x-button @click="show = true" variant="outline-gray" class="ms-auto">
                <span>{{ __('Edit on invoice') }}</span>
                <x-icons.pencil class="size-4 text-blue-600 group-hover:text-blue-700 transition-colors"/>
            </x-button>
        </div>
        <div x-show="show">
            <div class="flex items-center mb-4">
                <div class="text-sm text-medium text-gray-600">{{ __('Customer') }}</div>
                <div class="ms-auto flex items-center gap-2">
                    @if($contact_id)
                        <x-button wire:click="resetContactId" variant="outline-gray">
                            <span>{{ __('Assigned contact') }} (id: {{ $contact_id }})</span>
                            <x-icons.x class="size-4 text-blue-600 group-hover:text-red-500 transition-colors"/>
                        </x-button>
                    @endif
                    <x-button @click="show = false" variant="outline-gray" class="ms-auto">
                        <span>{{ __('Cancel editing') }}</span>
                        <x-icons.pencil class="size-4 text-blue-600 group-hover:text-blue-700 transition-colors"/>
                    </x-button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10 lg:gap-20">
                <div>
                    <div class="flex gap-2 mb-4">
                        <x-modal x-on:close-contact-search-modal.window="show = false">
                            <x-button wire:click="loadContacts" @click="show = !show">
                                <x-icons.user-search class="size-4"/>
                                <span>{{ __('Choose from contacts') }}</span>
                            </x-button>
                            <x-slot:body class="max-w-md">
                                <div class="mb-4">
                                    <div class="relative rounded-lg">
                                        <div class="absolute left-3 top-2.5">
                                            <x-icons.search class="size-5 text-gray-500"/>
                                        </div>
                                        <x-form.input wire:model.live.debounce.250ms="contact_search" class="ps-10" placeholder="{{ __('Search in contacts') }}"/>
                                    </div>
                                </div>
                                <div wire:loading.flex wire:target="loadContacts">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto size-10 text-blue-600 animate-spin" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 22c5.421 0 10-4.579 10-10h-2c0 4.337-3.663 8-8 8s-8-3.663-8-8c0-4.336 3.663-8 8-8V2C6.579 2 2 6.58 2 12c0 5.421 4.579 10 10 10z"></path>
                                    </svg>
                                </div>
                                @if($contacts)
                                    <div wire:loading.remove wire:target="loadContacts" class="rounded-lg border border-gray-200 overflow-hidden max-h-64 overflow-y-auto">
                                        @forelse($contacts as $contact)
                                            <div wire:click="fillFieldsFromContact({{ $contact->id }})" class="relative cursor-pointer py-2 px-4 border-b last:border-b-0 border-gray-200 hover:text-blue-600 hover:bg-gray-50 transition-colors">
                                                <div class="mb-1">{{ $contact->name }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Company ID') }}: {{ $contact->company_id }}</div>
                                                @if($contact->id === $contact_id)
                                                    <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                                        <x-icons.user-rounded class="size-5 text-green-600"/>
                                                    </div>
                                                @endif
                                            </div>
                                        @empty
                                            <div class="p-4 text-gray-500">{{ __('No contact found') }}</div>
                                        @endforelse
                                    </div>
                                @endif
                            </x-slot:body>
                        </x-modal>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <label class="w-full md:pt-2 md:w-1/3">{{ __('Name') }}</label>
                        <div class="w-full">
                            <x-form.input wire:model.blur="customer_company" @class(['border-red-500' => $errors->has('customer_company')])/>
                            <x-form.input-error name="customer_company"/>
                        </div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <label class="w-full md:pt-2 md:w-1/3">{{ __('Company ID') }}</label>
                        <div class="w-full">
                            <x-form.input wire:model.blur="customer_company_id" @class(['border-red-500' => $errors->has('customer_company_id')])/>
                            <x-form.input-error name="customer_company_id"/>
                        </div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <label class="w-full md:pt-2 md:w-1/3">{{ __('VAT ID') }}</label>
                        <div class="w-full">
                            <x-form.input wire:model.blur="customer_vat_id" @class(['border-red-500' => $errors->has('customer_vat_id')])/>
                            <x-form.input-error name="customer_vat_id"/>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex gap-4 mb-4">
                        <label class="w-full md:pt-2 md:w-1/3">{{ __('Address') }}</label>
                        <div class="w-full">
                            <x-form.input wire:model.blur="customer_address" @class(['border-red-500' => $errors->has('customer_address')])/>
                            <x-form.input-error name="customer_address"/>
                        </div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <label class="w-full md:pt-2 md:w-1/3">{{ __('City') }}</label>
                        <div class="w-full">
                            <x-form.input wire:model.blur="customer_city" @class(['border-red-500' => $errors->has('customer_city')])/>
                            <x-form.input-error name="customer_city"/>
                        </div>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <label class="w-full md:pt-2 md:w-1/3">{{ __('ZIP') }}</label>
                        <div class="w-full">
                            <x-form.input wire:model.blur="customer_zip" @class(['border-red-500' => $errors->has('customer_zip')])/>
                            <x-form.input-error name="customer_zip"/>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <label class="w-full md:pt-2 md:w-1/3">{{ __('Country') }}</label>
                        <div class="w-full">
                            <x-form.country-select wire:model.blur="customer_country" @class(['border-red-500' => $errors->has('customer_country')])/>
                            <x-form.input-error name="customer_country"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
    <x-card>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10 lg:gap-20">
            <div>
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
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/3">{{ __('Payment method') }}</label>
                    <div class="w-full">
                        <x-form.payment-select wire:model.live="payment_method" @class(['border-red-500' => $errors->has('payment_method')])/>
                        <x-form.input-error name="payment_method"/>
                    </div>
                </div>
                @if($payment_method === \App\Enums\PaymentMethod::BANK_TRANSFER->value)
                    <div class="flex gap-4">
                        <label class="w-full md:pt-2 md:w-1/3">{{ __('Bank account') }}</label>
                        <div class="w-full">
                            <x-form.select wire:model.live="bank_account_id" @class(['border-red-500' => $errors->has('bank_account_id')])>
                                @php
                                    $accounts = \App\Models\BankAccount::query()->get();
                                @endphp
                                <option>{{ __('Select bank account') }}</option>
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </x-form.select>
                            <x-form.input-error name="bank_account_id"/>
                        </div>
                    </div>
                @endif
            </div>
            <div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/3">{{ __('Date of issue') }}</label>
                    <div class="w-full">
                        <div x-data="{}" x-init="flatpickr($refs.input, { dateFormat: 'd. m. Y', minDate: '{{ now()->format('d. m. Y') }}'})">
                            <x-form.input x-ref="input" wire:model.blur="issued_at" @class(['border-red-500' => $errors->has('issued_at')])/>
                        </div>
                        <x-form.input-error name="issued_at"/>
                    </div>
                </div>
                <div class="flex gap-4 mb-4">
                    <label class="w-full md:pt-2 md:w-1/3">{{ __('Due date') }}</label>
                    <div class="w-full">
                        <div x-data="{}" x-init="flatpickr($refs.input, { dateFormat: 'd. m. Y', minDate: '{{ now()->format('d. m. Y') }}'})">
                            <x-form.input x-ref="input" wire:model.blur="due_at" @class(['border-red-500' => $errors->has('due_at')])/>
                        </div>
                        <x-form.input-error name="due_at"/>
                    </div>
                </div>
                <div class="flex gap-4">
                    <label class="w-full md:pt-2 md:w-1/3">{{ __('Currency') }}</label>
                    <div class="w-full">
                        <x-form.currency-select wire:model.live="currency" @class(['border-red-500' => $errors->has('currency')])/>
                        <x-form.input-error name="currency"/>
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
        <button wire:click="save" class="cursor-pointer py-3 px-6 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Edit invoice') }}</button>
    </div>
</div>
