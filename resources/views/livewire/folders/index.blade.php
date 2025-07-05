@section('title', __('Folders'))

<div>
    <x-header>
        <x-slot:title>{{ __('Folders') }}</x-slot:title>
        <x-slot:buttons>
            <x-modal x-on:open-folder-create-modal.window="show = true" x-on:close-folder-create-modal.window="show = false">
                <x-button @click="$dispatch('open-folder-create-modal')">
                    <x-icons.plus class="size-4"/>
                    <span>{{ __('New folder') }}</span>
                </x-button>
                <x-slot:body class="max-w-md">
                    <form wire:submit="store">
                        <div class="mb-4">
                            <x-form.input wire:model.blur="name" placeholder="{{ __('Name') }}" @class(['border-red-500' => $errors->has('name')])/>
                            <x-form.input-error name="name"/>
                        </div>
                        <x-button type="submit">{{ __('Add new folder') }}</x-button>
                    </form>
                </x-slot:body>
            </x-modal>
        </x-slot:buttons>
    </x-header>
    <div>
        <x-table card="true">
            @if($folders->isNotEmpty())
                <x-slot:head>
                    <x-table.row>
                        <x-table.head width="40%">{{ __('Name') }}</x-table.head>
                        <x-table.head></x-table.head>
                    </x-table.row>
                </x-slot:head>
                <x-slot:body>
                    @foreach($folders as $folder)
                        <x-table.row wire:key="folder-{{ $folder->id }}">
                            <x-table.column>
                                {{ $folder->name }}
                            </x-table.column>
                            <x-table.column align="right">
                                <x-table.action-dropdown>
                                    <x-slot:items>
                                        <x-table.action-dropdown.item>
                                            <x-icons.pencil class="size-5 text-blue-600"/>
                                            <span>{{ __('Edit') }}</span>
                                        </x-table.action-dropdown.item>
                                        <x-table.action-dropdown.item wire:click="delete({{ $folder->id }})" wire:confirm="{{ __('Are you sure you want to delete this record?') }}">
                                            <x-icons.trash class="size-5 text-blue-600"/>
                                            <span>{{ __('Delete') }}</span>
                                        </x-table.action-dropdown.item>
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
