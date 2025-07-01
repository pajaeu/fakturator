@section('title', __('Invoice number') . ' ' . $invoice->number)

<div>
    <x-header>
        <x-slot:title>{{ __('Invoice number') }} {{ $invoice->number }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('invoices.index') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.arrow-back class="size-4"/>
                <span>{{ __('Back') }}</span>
            </x-button>
            <x-button href="{{ route('invoices.edit', ['invoice' => $invoice]) }}" :link="true">
                <x-icons.pencil class="size-4"/>
                <span>{{ __('Edit') }}</span>
            </x-button>
            <x-button href="{{ route('invoices.print', ['invoice' => $invoice]) }}" :link="true" target="_blank">
                <x-icons.printer class="size-4"/>
                <span>{{ __('Print') }}</span>
            </x-button>
            <x-button href="{{ route('invoices.download', ['invoice' => $invoice]) }}" :link="true">
                <x-icons.download class="size-4"/>
                <span>{{ __('Download') }}</span>
            </x-button>
            @if(!$invoice->is_paid)
                <x-button>
                    <x-icons.cash class="size-4"/>
                    <span>{{ __('Pay') }}</span>
                </x-button>
            @endif
            <x-button wire:click="delete" wire:confirm="{{ __('Are you sure you want to delete this record?') }}" variant="danger">
                <x-icons.trash class="size-4"/>
                <span>{{ __('Delete') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <x-card class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-10 lg:gap-20">
            <div>
                <div class="mb-2 text-gray-500">{{ __('Customer') }}:</div>
                <div class="mb-1 font-medium">
                    @if($invoice->contact_id)
                        <a href="" class="text-blue-600 hover:underline">{{ $invoice->customer_company }}</a>
                    @else
                        <span>{{ $invoice->customer_company }}</span>
                    @endif
                </div>
                <div>{{ $invoice->customer_address }}</div>
                <div>{{ $invoice->customer_zip }} {{ $invoice->customer_city }}</div>
                <div class="mb-2">{{ $invoice->customer_country->label() }}</div>
                <div class="mb-1 text-sm"><span class="text-gray-500">{{ __('Company ID') }}:</span> {{ $invoice->customer_company_id }}</div>
                <div class="mb-1 text-sm"><span class="text-gray-500">{{ __('VAT ID') }}:</span> {{ $invoice->customer_vat_id }}</div>
            </div>
        </div>
    </x-card>
    <h2 class="mb-4 text-lg font-semibold">{{ __('Invoice items') }}</h2>
    <x-table :card="true">
        <x-slot:head>
            <x-table.row>
                <x-table.head width="40%">{{ __('Description') }}</x-table.head>
                <x-table.head width="15%">{{ __('Quantity') }}</x-table.head>
                <x-table.head align="right">{{ __('Price per unit') }}</x-table.head>
                <x-table.head align="right">{{ __('Total') }}</x-table.head>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($invoice->items as $item)
                <x-table.row>
                    <x-table.column>{{ $item['description'] }}</x-table.column>
                    <x-table.column>{{ $item['quantity'] }} {{ $item['unit'] }}</x-table.column>
                    <x-table.column align="right">{{ price((float) $item['unit_price'], $invoice->currency)->format() }}</x-table.column>
                    <x-table.column align="right">{{ price((float) $item['total'], $invoice->currency)->format() }}</x-table.column>
                </x-table.row>
            @endforeach
        </x-slot:body>
        <x-slot:after>
            <div class="p-5 pt-10 flex justify-end items-center text-lg font-medium">
                <div class="w-1/3">{{ __('Total to be paid') }}</div>
                <div class="text-xl font-semibold">{{ price($invoice->total_with_vat, $invoice->currency)->format() }}</div>
            </div>
        </x-slot:after>
    </x-table>
</div>