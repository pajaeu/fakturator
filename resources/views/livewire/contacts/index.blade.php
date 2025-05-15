<div>
    <x-header>
        <x-slot:title>{{ __('Contacts') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('contacts.create') }}" :link="true">
                <x-icons.plus class="size-4"/>
                <span>{{ __('New contact') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <x-table card="true">
        <x-slot:head>
            <x-table.row>
                <x-table.head width="10%">ID</x-table.head>
                <x-table.head>{{ __('Name') }}</x-table.head>
                <x-table.head></x-table.head>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($contacts as $contact)
                <x-table.row wire:key="{{ $contact->id }}">
                    <x-table.column>{{ $contact->id }}</x-table.column>
                    <x-table.column>
                        <a href="" class="block">
                            <div class="mb-1">{{ $contact->name }}</div>
                            <div class="text-xs text-gray-500">{{ __('Company ID') }}: {{ $contact->company_id }}</div>
                        </a>
                    </x-table.column>
                    <x-table.column align="right">
                        <x-table.action-dropdown>
                            <x-slot:items>
                                <x-table.action-dropdown.item>{{ __('Edit') }}</x-table.action-dropdown.item>
                                <x-table.action-dropdown.item wire:click="delete({{ $contact->id }})" wire:confirm="{{ __('Are you sure you want to delete this record?') }}">{{ __('Delete') }}</x-table.action-dropdown.item>
                            </x-slot:items>
                        </x-table.action-dropdown>
                    </x-table.column>
                </x-table.row>
            @endforeach
        </x-slot:body>
    </x-table>
</div>
