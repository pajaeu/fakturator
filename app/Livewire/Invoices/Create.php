<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\HasInvoiceItems;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    use HasInvoiceItems;

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

    public ?string $issued_at = null;

    public ?string $due_at = null;

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
            'customer_company_id' => [
                'required',
                'digits:8',
            ],
            'customer_vat_id' => Rule::when($this->customer_vat_id !== null, [
                'string',
                'min:10',
                'max:12',
            ]),
            'customer_company' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],
            'customer_address' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],
            'customer_city' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],
            'customer_country' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],
            'customer_zip' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'customer_phone' => Rule::when($this->customer_phone !== null, [
                'string',
                'min:6',
            ]),
            'customer_email' => Rule::when($this->customer_email !== null, [
                'email',
            ]),
            'number' => [
                'required',
                'string',
            ],
            'variable_symbol' => [
                'required',
                'string',
            ],
            'issued_at' => [
                'required',
                'date_format:d. m. Y',
            ],
            'due_at' => [
                'required',
                'date_format:d. m. Y',
            ],
        ];
    }

    public function updated(string $property): void
    {
        $this->validateOnly($property);

        $this->resetErrorBag($property);
    }

    public function save(): void
    {
        $this->validate();

        $this->validateItems();
    }

    public function render(): View
    {
        return view('livewire.invoices.create');
    }
}
