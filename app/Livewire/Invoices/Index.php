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

    public function delete(int $id): void
    {
        $invoice = Invoice::query()->find($id);

        if (! $invoice) {
            return;
        }

        $this->authorize('delete', $invoice);

        $invoice->delete();
    }

    public function render(): View
    {
        return view('livewire.invoices.index', [
            'invoices' => Invoice::query()->latest()->paginate(24),
        ]);
    }
}
