<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\CanPushNotifications;
use App\Models\Folder;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class Index extends Component
{
    use CanPushNotifications;
    use WithPagination;

    #[Url(as: 'folder')]
    public ?string $folderId = null;

    public bool $selectAllInvoices = false;

    /** @var array<mixed> */
    public array $selectedInvoices = [];

    public function updatedSelectAllInvoices(): void
    {
        $this->selectedInvoices = $this->selectAllInvoices ? Invoice::query()->pluck('id')->toArray() : [];
    }

    public function updatedSelectedInvoices(): void
    {
        $this->selectAllInvoices = false;
    }

    #[Computed]
    public function searchedFolder(): ?Folder
    {
        return $this->folderId ? Folder::query()->find($this->folderId) : null;
    }

    public function delete(int $id): void
    {
        $invoice = Invoice::query()->find($id);

        if (! $invoice) {
            return;
        }

        $this->authorize('delete', $invoice);

        $invoice->delete();

        $this->pushNotification(__('Deleted'));
    }

    public function bulkDelete(): void
    {
        Invoice::query()->whereIn('id', $this->selectedInvoices)->each(function ($invoice): void {
            $this->authorize('delete', $invoice);

            $invoice->delete();
        });

        $this->selectAllInvoices = false;
        $this->selectedInvoices = [];

        $this->pushNotification(__('Deleted'));
    }

    #[On('refresh-invoices')]
    public function render(): View
    {
        $invoices = Invoice::query()->latest()
            ->when($this->folderId, function (Builder $query) {
                $query->where('folder_id', $this->folderId);
            })
            ->paginate(24);

        return view('livewire.invoices.index', [
            'invoices' => $invoices,
            'folders' => Folder::all(),
        ]);
    }
}
