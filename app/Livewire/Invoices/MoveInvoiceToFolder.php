<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\CanPushNotifications;
use App\Models\Folder;
use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class MoveInvoiceToFolder extends Component
{
    use CanPushNotifications;

    public ?Invoice $invoice;

    public string|int $folder_id = '';

    #[On('open-move-to-folder-modal')]
    public function openModal(int $id): void
    {
        $this->reset('invoice', 'folder_id');

        $invoice = Invoice::query()->find($id);

        if (! $invoice) {
            return;
        }

        if ($invoice->folder) {
            $this->folder_id = $invoice->folder->id;
        }

        $this->invoice = $invoice;
    }

    public function move(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        /** @var Folder|null $folder */
        $folder = Folder::query()->find($data['folder_id']);

        if (! $this->invoice || ! $folder) {
            return;
        }

        $this->invoice->folder()->associate($folder);

        $this->invoice->save();

        $this->dispatch('refresh-invoices');

        $this->pushNotification(__('Moved'));

        $this->dispatch('close-move-to-folder-modal');
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'folder_id' => 'required|integer|exists:folders,id',
        ];
    }

    public function render(): View
    {
        return view('livewire.invoices.move-invoice-to-folder', [
            'folders' => Folder::all(),
        ]);
    }
}
