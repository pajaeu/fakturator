<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\CanPushNotifications;
use App\Livewire\Concerns\HasContactSearch;
use App\Livewire\Concerns\HasInvoiceItems;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Livewire\Invoices\Concerns\CreatesUpdatesInvoice;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class Edit extends Component
{
    use CanPushNotifications;
    use CreatesUpdatesInvoice;
    use HasContactSearch;
    use HasInvoiceItems;
    use ResetsValidationAfterUpdate;

    #[Locked]
    public Invoice $invoice;

    public string $paid_at = '';

    public function mount(Invoice $invoice): void
    {
        $this->invoice = $invoice;

        $this->fill($invoice);

        $this->issued_at = $invoice->issued_at->format('d. m. Y');
        $this->due_at = $invoice->due_at->format('d. m. Y');
        $this->paid_at = $invoice->is_paid ? $invoice->paid_at->format('d. m. Y') : '';
    }

    public function save(): void
    {
        $this->validate();

        $this->validateItems();

        $this->recalculateTotals();

        /** @var array<string, mixed> $data */
        $data = $this->pull([
            'contact_id',
            'customer_company_id',
            'customer_vat_id',
            'customer_company',
            'customer_address',
            'customer_city',
            'customer_country',
            'customer_zip',
            'customer_phone',
            'customer_email',
            'number',
            'variable_symbol',
            'total',
            'total_with_vat',
            'currency',
            'payment_method',
            'bank_account_id',
            'items',
        ]);

        if ($this->invoice->is_paid && $this->paid_at !== '') {
            $data['paid_at'] = Carbon::createFromFormat('d. m. Y', $this->paid_at)?->toDateString();
        }

        $this->invoice->update([
            ...$data,
            'issued_at' => Carbon::createFromFormat('d. m. Y', $this->issued_at)?->toDateString(),
            'due_at' => Carbon::createFromFormat('d. m. Y', $this->due_at)?->toDateString(),
        ]);

        $this->pushNotification(__('Success'));

        $this->redirectRoute('invoices.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.invoices.edit');
    }
}
