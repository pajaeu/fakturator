<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

final class Index extends Component
{
    use WithPagination;

    public bool $selectAllInvoices = false;

    public array $selectedInvoices = [];

    public function updatedSelectAllInvoices(): void
    {
        $this->selectedInvoices = $this->selectAllInvoices ? Invoice::query()->pluck('id')->toArray() : [];
    }

    public function updatedSelectedInvoices(): void
    {
        $this->selectAllInvoices = false;
    }

    public function delete(int $id): void
    {
        $invoice = Invoice::query()->find($id);

        if (! $invoice) {
            return;
        }

        $this->authorize('delete', $invoice);

        $invoice->delete();
    }

    public function bulkDelete(): void
    {
        Invoice::query()->whereIn('id', $this->selectedInvoices)->each(function ($invoice): void {
            $this->authorize('delete', $invoice);

            $invoice->delete();
        });

        $this->selectAllInvoices = false;
        $this->selectedInvoices = [];
    }

    public function render(): View
    {
        return view('livewire.invoices.index', [
            'invoices' => Invoice::query()->latest()->paginate(24),
        ]);
    }
}
