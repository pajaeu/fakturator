<?php

declare(strict_types=1);

namespace App\Livewire\Folders;

use App\Livewire\Concerns\CanPushNotifications;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Models\Folder;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

final class Index extends Component
{
    use CanPushNotifications;
    use ResetsValidationAfterUpdate;
    use WithPagination;

    public string $name = '';

    #[On('open-folder-create-modal')]
    #[On('close-folder-create-modal')]
    public function resetCreateModal(): void
    {
        $this->reset('name');

        $this->resetErrorBag('name');
    }

    public function store(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        Folder::query()->create([
            ...$data,
            'user_id' => auth()->id(),
        ]);

        $this->dispatch('close-folder-create-modal');

        $this->pushNotification(__('Success'));
    }

    public function delete(int $id): void
    {
        $folder = Folder::query()->find($id);

        if (! $folder) {
            return;
        }

        $this->authorize('delete', $folder);

        $folder->delete();

        $this->pushNotification(__('Deleted'));
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
        ];
    }

    public function render(): View
    {
        return view('livewire.folders.index', [
            'folders' => Folder::query()->latest()->paginate(12),
        ]);
    }
}
