<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Actions\GenerateLatestInvoiceNumber;
use App\Enums\Currency;
use App\Enums\PaymentMethod;
use App\Livewire\Concerns\CanCreateContact;
use App\Livewire\Concerns\CanPushNotifications;
use App\Livewire\Concerns\HasContactSearch;
use App\Livewire\Concerns\HasInvoiceItems;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Livewire\Invoices\Concerns\CreatesUpdatesInvoice;
use App\Models\BankAccount;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    use CanCreateContact;
    use CanPushNotifications;
    use CreatesUpdatesInvoice;
    use HasContactSearch;
    use HasInvoiceItems;
    use ResetsValidationAfterUpdate;

    public function mount(): void
    {
        $this->addItem();

        $this->setDefaultValues();
    }

    public function save(): void
    {
        $this->validate();

        $this->validateItems();

        $this->recalculateTotals();

        /** @var User $user */
        $user = auth()->user();

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

        Invoice::query()->create([
            ...$data,
            'issued_at' => Carbon::createFromFormat('d. m. Y', $this->issued_at)?->toDateString(),
            'due_at' => Carbon::createFromFormat('d. m. Y', $this->due_at)?->toDateString(),
            'supplier_company' => $user->billing_company,
            'supplier_company_id' => $user->company_id,
            'supplier_vat_id' => $user->vat_id,
            'supplier_address' => $user->billing_address,
            'supplier_city' => $user->billing_city,
            'supplier_country' => $user->billing_country,
            'supplier_zip' => $user->billing_zip,
            'user_id' => $user->id,
        ]);

        $this->pushNotification(__('Success'));

        $this->redirectRoute('invoices.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.invoices.create');
    }

    private function setDefaultValues(): void
    {
        $this->issued_at = now()->format('d. m. Y');
        $this->due_at = now()->addWeek()->format('d. m. Y');

        $number = GenerateLatestInvoiceNumber::handle();

        $this->number = $number;

        $this->variable_symbol = $number;

        $this->currency = Currency::CZK->value;
        $this->payment_method = BankAccount::query()->exists() ? PaymentMethod::BANK_TRANSFER->value : PaymentMethod::CASH->value;
        $this->bank_account_id = BankAccount::query()->where('default', true)->first()->id ?? null;
    }
}
