<div>
    <x-header>
        <x-slot:title>{{ __('Bank accounts') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('settings.index') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.arrow-back class="size-4"/>
                <span>{{ __('Back') }}</span>
            </x-button>
            <x-modal x-on:open-account-create-modal.window="show = true" x-on:close-account-create-modal.window="show = false">
                <x-button @click="show = !show">
                    <x-icons.plus class="size-4"/>
                    <span>{{ __('Add new account') }}</span>
                </x-button>
                <x-slot:body class="max-w-md">
                    <form wire:submit="addNewAccount">
                        <div class="mb-4">
                            <x-form.input wire:model.blur="name" placeholder="{{ __('Name') }}" @class(['border-red-500' => $errors->has('name')])/>
                            <x-form.input-error name="name"/>
                        </div>
                        <div class="flex gap-2 mb-4">
                            <div class="w-2/3">
                                <x-form.input wire:model.blur="number" placeholder="{{ __('Number') }}" @class(['border-red-500' => $errors->has('number')])/>
                                <x-form.input-error name="number"/>
                            </div>
                            <div>
                                <x-form.input wire:model.blur="bank_code" placeholder="{{ __('Bank code') }}" @class(['border-red-500' => $errors->has('bank_code')])/>
                                <x-form.input-error name="bank_code"/>
                            </div>
                        </div>
                        <div class="mb-4">
                            <x-form.input wire:model.blur="iban" placeholder="{{ __('IBAN') }}" @class(['border-red-500' => $errors->has('iban')])/>
                            <x-form.input-error name="iban"/>
                        </div>
                        <div class="mb-4">
                            <x-form.input wire:model.blur="swift" placeholder="{{ __('SWIFT') }}" @class(['border-red-500' => $errors->has('swift')])/>
                            <x-form.input-error name="swift"/>
                        </div>
                        <x-button type="submit">{{ __('Add new account') }}</x-button>
                    </form>
                </x-slot:body>
            </x-modal>
        </x-slot:buttons>
    </x-header>
    @forelse($accounts as $account)
        <x-card wire:key="account-{{ $account->id }}" class="mb-4 flex items-center">
            <div>
                <div class="text-lg mb-1">{{ $account->name }}</div>
                <div class="text-sm text-gray-500">
                    <span>{{ $account->number }}</span>
                    <span>/</span>
                    <span>{{ $account->bank_code }}</span>
                </div>
            </div>
            <div class="ms-auto">
                @if($account->default)
                    <span class="text-gray-400 italic">{{ __('default account') }}</span>
                @else
                    <button wire:click="setAsDefault({{ $account->id }})" class="cursor-pointer flex items-center gap-2 text-gray-600 hover:text-gray-800 hover:underline transition-colors">{{ __('Set as default') }}</button>
                @endif
            </div>
        </x-card>
    @empty
        <div class="flex justify-center">
            <x-button @click="$dispatch('open-account-create-modal')">
                <x-icons.plus class="size-4"/>
                <span>{{ __('Add new account') }}</span>
            </x-button>
        </div>
    @endforelse
</div>
