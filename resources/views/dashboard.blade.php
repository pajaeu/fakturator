@section('title', __('Simple online invoicing system'))

<x-app-layout>
    <livewire:dashboard.monthly-incomes-widget/>
    <div class="mt-12">
        <h2 class="mb-4 text-xl font-semibold text-center">{{ __('Recent invoices') }}</h2>
        <x-table card="true">
            @if($invoices->isNotEmpty())
                <x-slot:head>
                    <x-table.row>
                        <x-table.head width="15%">{{ __('Bill number') }}</x-table.head>
                        <x-table.head>{{ __('Customer') }}</x-table.head>
                        <x-table.head align="right">{{ __('Issued at') }}</x-table.head>
                        <x-table.head align="right">{{ __('Total with VAT') }}</x-table.head>
                        <x-table.head></x-table.head>
                    </x-table.row>
                </x-slot:head>
                <x-slot:body>
                    @foreach($invoices as $invoice)
                        <x-table.row wire:key="invoice-{{ $invoice->id }}">
                            <x-table.column>{{ $invoice->number }}</x-table.column>
                            <x-table.column>{{ $invoice->customer_company }}</x-table.column>
                            <x-table.column align="right">{{ $invoice->issued_at->format('d. m. Y') }}</x-table.column>
                            <x-table.column align="right">{{ price($invoice->total, $invoice->currency)->format() }}</x-table.column>
                            <x-table.column align="right">
                                <x-table.action-dropdown>
                                    <x-slot:items>
                                        <x-table.action-dropdown.item href="{{ route('invoices.edit', ['invoice' => $invoice]) }}" :link="true" wire:navigate>
                                            <x-icons.pencil class="size-5 text-blue-600"/>
                                            <span>{{ __('Edit') }}</span>
                                        </x-table.action-dropdown.item>
                                        <x-table.action-dropdown.item href="{{ route('invoices.print', ['invoice' => $invoice]) }}" :link="true" target="_blank">
                                            <x-icons.printer class="size-5 text-blue-600"/>
                                            <span>{{ __('Print PDF') }}</span>
                                        </x-table.action-dropdown.item>
                                        <x-table.action-dropdown.item href="{{ route('invoices.download', ['invoice' => $invoice]) }}" :link="true">
                                            <x-icons.download class="size-5 text-blue-600"/>
                                            <span>{{ __('Download') }}</span>
                                        </x-table.action-dropdown.item>
                                        <x-table.action-dropdown.item wire:click="delete({{ $invoice->id }})" wire:confirm="{{ __('Are you sure you want to delete this record?') }}">
                                            <x-icons.trash class="size-5 text-blue-600"/>
                                            <span>{{ __('Delete') }}</span>
                                        </x-table.action-dropdown.item>
                                    </x-slot:items>
                                </x-table.action-dropdown>
                            </x-table.column>
                        </x-table.row>
                    @endforeach
                </x-slot:body>
                <x-slot:after>
                    <div class="py-3 text-center border-t border-gray-100">
                        <a href="{{ route('invoices.index') }}" class="text-sm text-gray-500 underline hover:text-gray-800 hover:no-underline transition-colors" wire:navigate>{{ __('All invoices') }}</a>
                    </div>
                </x-slot:after>
            @else
                <x-slot:body>
                    <x-table.empty-state/>
                </x-slot:body>
            @endif
        </x-table>
    </div>
</x-app-layout>