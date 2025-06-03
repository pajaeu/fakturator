<?php

declare(strict_types=1);

namespace App\Livewire\Invoices\Concerns;

use App\Enums\Country;
use App\Enums\Currency;
use App\Enums\PaymentMethod;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

trait CreatesUpdatesInvoice
{
    public string $customer_company_id = '';

    public ?string $customer_vat_id = null;

    public string $customer_company = '';

    public string $customer_address = '';

    public string $customer_city = '';

    public string $customer_country = '';

    public string $customer_zip = '';

    public ?string $customer_phone = null;

    public ?string $customer_email = null;

    public ?int $contact_id = null;

    public string $number = '';

    public string $variable_symbol = '';

    public string $issued_at = '';

    public string $due_at = '';

    public string $currency = '';

    public string $payment_method = '';

    public ?int $bank_account_id = null;

    public function resetContactId(): void
    {
        $this->reset('contact_id');
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'customer_company_id' => 'required|digits:8',
            'customer_vat_id' => Rule::when($this->customer_vat_id !== null, 'string|min:10|max:12'),
            'customer_company' => 'required|string|min:3|max:255',
            'customer_address' => 'required|string|min:3|max:255',
            'customer_city' => 'required|string|min:2|max:255',
            'customer_country' => [
                'required',
                Rule::in(Country::cases()),
            ],
            'customer_zip' => 'required|string|min:5|max:255',
            'customer_phone' => Rule::when($this->customer_phone !== null, 'string|min:6'),
            'customer_email' => Rule::when($this->customer_email !== null, 'email'),
            'number' => [
                'required',
                'string',
                Rule::unique('invoices')->where(fn (Builder $query) => $query->where('user_id', auth()->id()))->ignore($this->invoice->id ?? null),
            ],
            'variable_symbol' => 'required|string',
            'issued_at' => 'required|date_format:d. m. Y',
            'due_at' => 'required|date_format:d. m. Y',
            'currency' => [
                'required',
                Rule::in(Currency::cases()),
            ],
            'payment_method' => [
                'required',
                Rule::in(PaymentMethod::cases()),
            ],
            'bank_account_id' => Rule::when($this->payment_method === PaymentMethod::BANK_TRANSFER->value, 'required|exists:bank_accounts,id'),
        ];
    }
}
