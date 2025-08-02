<x-modal x-on:open-move-to-folder-modal.window="show = true" x-on:close-move-to-folder-modal.window="show = false">
    <x-slot:body class="max-w-md">
        <form wire:submit="move">
            <div class="mb-4">
                <x-form.select wire:model="folder_id">
                    <option>{{ __('Select folder') }}</option>
                    @foreach($folders as $folder)
                        <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                    @endforeach
                </x-form.select>
                <x-form.input-error name="folder_id"/>
            </div>
            <x-button type="submit">{{ __('Move to folder') }}</x-button>
        </form>
    </x-slot:body>
</x-modal>