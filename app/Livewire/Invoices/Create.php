<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\HasInvoiceItems;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    use HasInvoiceItems;
    use ResetsValidationAfterUpdate;

    public ?string $customer_company_id = null;

    public ?string $customer_vat_id = null;

    public ?string $customer_company = null;

    public ?string $customer_address = null;

    public ?string $customer_city = null;

    public ?string $customer_country = null;

    public ?string $customer_zip = null;

    public ?string $customer_phone = null;

    public ?string $customer_email = null;

    public ?int $contact_id = null;

    public ?string $number = null;

    public ?string $variable_symbol = null;

    public string $issued_at;

    public string $due_at;

    public function mount(): void
    {
        $this->addItem();

        $this->issued_at = now()->format('d. m. Y');
        $this->due_at = now()->addWeek()->format('d. m. Y');
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'customer_company_id' => 'required|digits:8',
            'customer_vat_id' => Rule::when($this->customer_vat_id !== null, 'string|min:10|max:12'),
            'customer_company' => 'required|string|min:6|max:255',
            'customer_address' => 'required|string|min:6|max:255',
            'customer_city' => 'required|string|min:6|max:255',
            'customer_country' => 'required|string|min:6|max:255',
            'customer_zip' => 'required|string|min:5|max:255',
            'customer_phone' => Rule::when($this->customer_phone !== null, 'string|min:6'),
            'customer_email' => Rule::when($this->customer_email !== null, 'email'),
            'number' => 'required|string',
            'variable_symbol' => 'required|string',
            'issued_at' => 'required|date_format:d. m. Y',
            'due_at' => 'required|date_format:d. m. Y',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->validateItems();

        /** @var User $user */
        $user = auth()->user();

        /** @var array<string, mixed> $data */
        $data = $this->pull([
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
        ]);

        Invoice::query()->create($data + [
            'issued_at' => Carbon::createFromFormat('d. m. Y', $this->issued_at)?->toDateString(),
            'due_at' => Carbon::createFromFormat('d. m. Y', $this->due_at)?->toDateString(),
            'supplier_company' => $user->billing_company,
            'supplier_company_id' => $user->company_id,
            'supplier_vat_id' => $user->vat_id,
            'supplier_address' => $user->billing_address,
            'supplier_city' => $user->billing_city,
            'supplier_country' => $user->billing_country,
            'supplier_zip' => $user->billing_zip,
            'items' => $this->items,
            'user_id' => $user->id,
        ]);
    }

    public function render(): View
    {
        return view('livewire.invoices.create');
    }
}
