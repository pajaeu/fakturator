<div>
    <x-header>
        <x-slot:title>{{ __('Contacts') }}</x-slot:title>
        <x-slot:buttons>
            <x-button href="{{ route('contacts.create') }}" :link="true" wire:navigate>
                <x-icons.plus class="size-4"/>
                <span>{{ __('New contact') }}</span>
            </x-button>
        </x-slot:buttons>
    </x-header>
    <div x-data="{ selectedContacts: $wire.entangle('selectedContacts') }">
        <x-table.bulk-actions-dropdown wire:key="contact-bulk-actions" class="mb-4" x-show="selectedContacts.length > 0" x-cloak>
            <x-slot:items>
                <x-table.bulk-actions-dropdown.item wire:click="bulkDelete" wire:confirm="{{ __('Are you sure you want to delete all selected records?') }}">
                    <span>{{ __('Delete all') }}</span>
                </x-table.bulk-actions-dropdown.item>
            </x-slot:items>
        </x-table.bulk-actions-dropdown>
        <x-table card="true">
        @if($contacts->isNotEmpty())
            <x-slot:head>
                <x-table.row>
                    <x-table.head width="50px">
                        <x-form.checkbox wire:model.live="selectAllContacts" />
                    </x-table.head>
                    <x-table.head width="10%">ID</x-table.head>
                    <x-table.head>{{ __('Name') }}</x-table.head>
                    <x-table.head></x-table.head>
                </x-table.row>
            </x-slot:head>
            <x-slot:body>
                @foreach($contacts as $contact)
                    <x-table.row wire:key="contact-{{ $contact->id }}">
                        <x-table.column>
                            <x-form.checkbox wire:model.live="selectedContacts" value="{{ $contact->id }}"/>
                        </x-table.column>
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
        @else
            <x-slot:body>
                <x-table.empty-state/>
            </x-slot:body>
        @endif
    </x-table>
    </div>
</div>
