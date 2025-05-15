<div>
    <x-header>
        <x-slot:title>{{ __('Contacts') }}</x-slot:title>
        <x-slot:buttons>
            <a href="{{ route('contacts.create') }}" class="flex items-center gap-2 py-2 px-4 rounded-full text-sm text-blue-600 font-medium border border-blue-600 hover:text-white hover:bg-blue-600 transition-colors">
                <x-icons.plus class="size-4"/>
                <span>{{ __('New contact') }}</span>
            </a>
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
                <x-table.row>
                    <x-table.column>{{ $contact->id }}</x-table.column>
                    <x-table.column>
                        <a href="" class="block">
                            <div class="mb-1">{{ $contact->name }}</div>
                            <div class="text-xs text-gray-500">{{ __('Company ID') }}: {{ $contact->company_id }}</div>
                        </a>
                    </x-table.column>
                    <x-table.column align="right"></x-table.column>
                </x-table.row>
            @endforeach
        </x-slot:body>
    </x-table>
</div>
