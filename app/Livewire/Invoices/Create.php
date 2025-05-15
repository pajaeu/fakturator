<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\HasInvoiceItems;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    use HasInvoiceItems;

    public function mount(): void
    {
        $this->addItem();
    }

    public function save(): void
    {
        $this->validateItems();
    }

    public function render(): View
    {
        return view('livewire.invoices.create');
    }
}
