@section('title', __('Invoices'))

<div>
    <x-header>
        <x-slot:title>{{ __('Invoices') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('invoices.create') }}" :link="true" wire:navigate>
                <x-icons.plus class="size-4"/>
                <span>{{ __('New bill') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <div x-data="{ selectedInvoices: $wire.entangle('selectedInvoices') }">
        <x-table.bulk-actions-dropdown wire:key="invoice-bulk-actions" class="mb-4" x-show="selectedInvoices.length > 0" x-cloak>
            <x-slot:items>
                <x-table.bulk-actions-dropdown.item wire:click="bulkDelete" wire:confirm="{{ __('Are you sure you want to delete all selected records?') }}">
                    <span>{{ __('Delete all') }}</span>
                </x-table.bulk-actions-dropdown.item>
            </x-slot:items>
        </x-table.bulk-actions-dropdown>
        <x-table card="true">
            @if($invoices->isNotEmpty())
                <x-slot:head>
                    <x-table.row>
                        <x-table.head width="50px">
                            <x-form.checkbox wire:model.live="selectAllInvoices" />
                        </x-table.head>
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
                            <x-table.column>
                                <x-form.checkbox wire:model.live="selectedInvoices" value="{{ $invoice->id }}"/>
                            </x-table.column>
                            <x-table.column>{{ $invoice->number }}</x-table.column>
                            <x-table.column>{{ $invoice->customer_company }}</x-table.column>
                            <x-table.column align="right">{{ $invoice->issued_at->format('d. m. Y') }}</x-table.column>
                            <x-table.column align="right">{{ price($invoice->total, $invoice->currency)->format() }}</x-table.column>
                            <x-table.column align="right">
                                <x-table.action-dropdown>
                                    <x-slot:items>
                                        <x-table.action-dropdown.item href="{{ route('invoices.edit', ['invoice' => $invoice]) }}" :link="true" wire:navigate>{{ __('Edit') }}</x-table.action-dropdown.item>
                                        <x-table.action-dropdown.item href="{{ route('invoices.print', ['invoice' => $invoice]) }}" :link="true" target="_blank">{{ __('Print PDF') }}</x-table.action-dropdown.item>
                                        <x-table.action-dropdown.item href="{{ route('invoices.download', ['invoice' => $invoice]) }}" :link="true">{{ __('Download') }}</x-table.action-dropdown.item>
                                        <x-table.action-dropdown.item wire:click="delete({{ $invoice->id }})" wire:confirm="{{ __('Are you sure you want to delete this record?') }}">{{ __('Delete') }}</x-table.action-dropdown.item>
                                    </x-slot:items>
                                </x-table.action-dropdown>
                            </x-table.column>
                        </x-table.row>
                    @endforeach
                </x-slot:body>
            @else
                <x-slot:body>
                    <x-table.empty-state/>
                </x-slot:body>
            @endif
        </x-table>
    </div>
</div>
