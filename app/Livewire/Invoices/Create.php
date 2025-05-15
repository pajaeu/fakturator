<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\HasInvoiceItems;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    use HasInvoiceItems;

    public ?int $contact_id = null;

    public ?string $number = null;

    public ?string $variable_symbol = null;

    public ?string $issued_at = null;

    public ?string $due_at = null;

    public function mount(): void
    {
        $this->addItem();

        $this->issued_at = now()->format('d. m. Y');
        $this->due_at = now()->addWeek()->format('d. m. Y');
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
