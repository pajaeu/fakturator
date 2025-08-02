<?php

declare(strict_types=1);

namespace App\Livewire\Folders;

use App\Livewire\Concerns\CanPushNotifications;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Models\Folder;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class Edit extends Component
{
    use CanPushNotifications;
    use ResetsValidationAfterUpdate;

    #[Locked]
    public Folder $folder;

    public string $name = '';

    public function mount(Folder $folder): void
    {
        $this->name = $folder->name;
    }

    public function save(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        $this->folder->update([
            'name' => $data['name'],
        ]);

        $this->pushNotification(__('Success'));
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
        return view('livewire.folders.edit');
    }
}
