<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\HasInvoiceItems;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    use HasInvoiceItems;

    public ?string $issued_at = null;

    public ?string $due_at = null;

    public function mount(): void
    {
        $this->addItem();

        $this->issued_at = now()->toDateString();
        $this->due_at = now()->addWeek()->toDateString();
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
