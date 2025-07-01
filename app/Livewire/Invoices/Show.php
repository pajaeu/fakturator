<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\CanPushNotifications;
use App\Models\Invoice;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class Show extends Component
{
    use CanPushNotifications;

    #[Locked]
    public Invoice $invoice;

    public function mount(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->invoice);

        $this->invoice->delete();

        $this->pushNotification(__('Deleted'));

        $this->redirectRoute('invoices.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.invoices.show');
    }
}
