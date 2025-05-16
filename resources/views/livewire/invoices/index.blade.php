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
    <x-table card="true">
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
                <x-table.row wire:key="{{ $invoice->id }}">
                    <x-table.column>{{ $invoice->number }}</x-table.column>
                    <x-table.column>{{ $invoice->customer_company }}</x-table.column>
                    <x-table.column align="right">{{ $invoice->issued_at->format('d. m. Y') }}</x-table.column>
                    <x-table.column align="right">{{ price($invoice->total, $invoice->currency)->format() }}</x-table.column>
                    <x-table.column align="right">
                        <x-table.action-dropdown>
                            <x-slot:items>
                                <x-table.action-dropdown.item>{{ __('Edit') }}</x-table.action-dropdown.item>
                                <x-table.action-dropdown.item>{{ __('Print') }}</x-table.action-dropdown.item>
                                <x-table.action-dropdown.item>{{ __('Download') }}</x-table.action-dropdown.item>
                                <x-table.action-dropdown.item wire:click="delete({{ $invoice->id }})" wire:confirm="{{ __('Are you sure you want to delete this record?') }}">{{ __('Delete') }}</x-table.action-dropdown.item>
                            </x-slot:items>
                        </x-table.action-dropdown>
                    </x-table.column>
                </x-table.row>
            @endforeach
        </x-slot:body>
    </x-table>
</div>
