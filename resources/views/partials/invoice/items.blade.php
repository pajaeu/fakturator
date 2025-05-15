<x-card>
    <div class="mb-5">
        <div class="flex gap-2 mb-2 text-sm text-gray-600 font-semibold items-center">
            <div class="w-10"></div>
            <div class="flex-1">{{ __('Description') }}</div>
            <div class="w-20">{{ __('Quantity') }}</div>
            <div class="w-20">{{ __('Unit') }}</div>
            <div class="w-1/5">{{ __('Price per unit') }}</div>
            <div class="w-20">{{ __('VAT rate') }}</div>
            <div class="flex-1 text-end">{{ __('Total') }}</div>
            <div class="w-10 text-end"></div>
        </div>
        <div x-data="{
            init() {
                const el = this.$el;
                new Sortable(el, {
                    animation: 150,
                    handle: '.handle',
                    onEnd: (evt) => {
                        const newOrder = Array.from(el.children)
                            .map(child => child.getAttribute('data-id'));
                        @this.call('updateItemOrder', newOrder);
                    }
                });
            }
        }">
            @foreach($items as $index => $item)
                <div wire:key="item_{{ $index }}" class="flex gap-2 mb-2 items-center" data-id="{{ $index }}">
                    <div class="w-10">
                        <button class="cursor-move text-gray-300 hover:text-gray-500 transition-colors handle">
                            <x-icons.bars class="size-8"/>
                        </button>
                    </div>
                    <div class="flex-1">
                        @php($errorKey = "items.$index.description")
                        <x-form.input wire:model.live="items.{{ $index }}.description" @class(['border-red-500' => $errors->has($errorKey)])/>
                    </div>
                    <div class="w-20">
                        @php($errorKey = "items.$index.quantity")
                        <x-form.input type="number" wire:model.blur="items.{{ $index }}.quantity" @class(['border-red-500' => $errors->has($errorKey)])/>
                    </div>
                    <div class="w-20">
                        @php($errorKey = "items.$index.unit")
                        <x-form.input wire:model.blur="items.{{ $index }}.unit" placeholder="{{ __('pcs') }}" @class(['border-red-500' => $errors->has($errorKey)])/>
                    </div>
                    <div class="w-1/5">
                        @php($errorKey = "items.$index.unit_price")
                        <x-form.input type="number" step="0.01" wire:model.blur="items.{{ $index }}.unit_price" @class(['border-red-500' => $errors->has($errorKey)])/>
                    </div>
                    <div class="w-20">
                        <div class="py-2 px-4 rounded-lg border border-gray-300 bg-gray-50">
                            <input type="hidden" wire:model="items.{{ $index }}.vat_rate">
                            <span>{{ $item['vat_rate'] }}%</span>
                        </div>
                    </div>
                    <div class="flex-1 text-end">
                        <div class="py-2 px-4 rounded-lg border border-gray-300 bg-gray-50">
                            <input type="hidden" wire:model="items.{{ $index }}.total">
                            <span>{{ number_format((float) $item['total'], decimals: 2, decimal_separator: ',', thousands_separator: ' ') }} Kč</span>
                        </div>
                    </div>
                    <div class="w-10">
                        <button wire:click="removeItem({{ $index }})" class="ms-auto cursor-pointer size-7 text-white flex items-center justify-center rounded-full bg-gray-500 hover:bg-gray-800 transition-colors">
                            <x-icons.x class="size-4"/>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <x-button wire:click="addItem">
        <x-icons.plus class="size-4"/>
        <span>{{ __('Add item') }}</span>
    </x-button>
</x-card>