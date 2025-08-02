@section('title', __('VAT rates'))

<div>
    <x-header>
        <x-slot:title>{{ __('VAT rates') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('settings.index') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.arrow-back class="size-4"/>
                <span>{{ __('Back') }}</span>
            </x-button>
            <x-modal x-on:open-rate-create-modal.window="show = true" x-on:close-rate-create-modal.window="show = false">
                <x-button @click="$dispatch('open-rate-create-modal')">
                    <x-icons.plus class="size-4"/>
                    <span>{{ __('Add rate') }}</span>
                </x-button>
                <x-slot:body class="max-w-md">
                    <form wire:submit="add">
                        <div class="mb-4">
                            <x-form.input wire:model="name" placeholder="{{ __('Name') }}" @class(['border-red-500' => $errors->has('name')])/>
                            <x-form.input-error name="name"/>
                        </div>
                        <div class="mb-4">
                            <x-form.input wire:model="rate" type="number" placeholder="{{ __('Rate') }}" @class(['border-red-500' => $errors->has('rate')])/>
                            <x-form.input-error name="rate"/>
                        </div>
                        <x-button type="submit">{{ __('Add rate') }}</x-button>
                    </form>
                </x-slot:body>
            </x-modal>
        </x-slot:buttons>
    </x-header>
    @forelse($rates as $rate)
        <x-card wire:key="rate-{{ $rate->id }}" class="mb-4 flex items-center">
            <div class="md:w-1/3">{{ $rate->name }}</div>
            <div>{{ $rate->rate }}%</div>
            <div class="ms-auto">
                <button wire:click="delete({{ $rate->id }})" wire:confirm="{{ __('Are you sure you want to delete this record?') }}" class="cursor-pointer flex items-center gap-2 text-gray-600 hover:text-gray-800 hover:underline transition-colors">
                    <x-icons.trash class="size-4"/>
                </button>
            </div>
        </x-card>
    @empty
        <div class="flex justify-center">
            <x-button @click="$dispatch('open-rate-create-modal')">
                <x-icons.plus class="size-4"/>
                <span>{{ __('Add rate') }}</span>
            </x-button>
        </div>
    @endforelse
</div>
