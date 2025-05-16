<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Actions\Ares\GetCompanyDetailsFromCompanyId;
use App\Livewire\Concerns\HasInvoiceItems;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class Create extends Component
{
    use HasInvoiceItems;
    use ResetsValidationAfterUpdate;

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

    public string $contact_search = '';

    public ?string $new_contact_company_id = null;

    /** @var Collection<int, Contact> */
    #[Locked]
    public Collection $contacts;

    public function mount(): void
    {
        $this->addItem();

        $this->issued_at = now()->format('d. m. Y');
        $this->due_at = now()->addWeek()->format('d. m. Y');
    }

    public function updatedContactSearch(): void
    {
        $this->loadContacts();
    }

    public function loadContacts(): void
    {
        $this->contacts = Contact::query()
            ->whereLike('name', sprintf('%%%s%%', $this->contact_search))
            ->orWhereLike('company_id', sprintf('%%%s%%', $this->contact_search))
            ->get();
    }

    public function fillFieldsFromContact(int $contactId): void
    {
        $contact = Contact::query()->find($contactId);

        if (! $contact) {
            return;
        }

        $this->reset(['contact_search', 'contacts']);

        $this->fillCustomerFieldsFromContact($contact);

        $this->dispatch('close-contact-search-modal');
    }

    public function addNewContact(): void
    {
        $this->validate([
            'new_contact_company_id' => 'required|digits:8',
        ]);

        $contact = Contact::query()->where('company_id', $this->new_contact_company_id)->first();

        if ($contact) {
            $this->addError('new_contact_company_id', __('This contact already exists in your account.'));

            return;
        }

        $company_id = is_string($this->new_contact_company_id) ? $this->new_contact_company_id : '';

        try {
            $data = GetCompanyDetailsFromCompanyId::handle($company_id);
        } catch (Exception) {
            $this->addError('new_contact_company_id', __('Company details could not be found.'));

            return;
        }

        try {
            $contact = Contact::query()->create([
                'company_id' => $data['company_id'],
                'vat_id' => $data['vat_id'],
                'name' => $data['company'],
                'address' => $data['address'],
                'city' => $data['city'],
                'zip' => $data['zip'],
                'country' => $data['country'],
                'user_id' => auth()->id(),
            ]);

            $this->fillCustomerFieldsFromContact($contact);
        } catch (Exception) {
            $this->addError('new_contact_company_id', __('Contact could not be created.'));
        }

        $this->reset('new_contact_company_id');

        $this->dispatch('close-contact-create-modal');
    }

    public function save(): void
    {
        $this->validate();

        $this->validateItems();

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
            'items' => $this->items,
            'user_id' => $user->id,
        ]);
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
            'customer_country' => 'required|string|size:2',
            'customer_zip' => 'required|string|min:5|max:255',
            'customer_phone' => Rule::when($this->customer_phone !== null, 'string|min:6'),
            'customer_email' => Rule::when($this->customer_email !== null, 'email'),
            'number' => 'required|string',
            'variable_symbol' => 'required|string',
            'issued_at' => 'required|date_format:d. m. Y',
            'due_at' => 'required|date_format:d. m. Y',
        ];
    }

    public function render(): View
    {
        return view('livewire.invoices.create');
    }

    private function fillCustomerFieldsFromContact(Contact $contact): void
    {
        $this->contact_id = $contact->id;
        $this->customer_company = $contact->name;
        $this->customer_company_id = $contact->company_id;
        $this->customer_vat_id = $contact->vat_id;
        $this->customer_address = $contact->address;
        $this->customer_city = $contact->city;
        $this->customer_zip = $contact->zip;
        $this->customer_country = $contact->country->value;
    }
}
