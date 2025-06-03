<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Locked;

trait HasContactSearch
{
    public string $contact_search = '';

    /** @var Collection<int, Contact> */
    #[Locked]
    public Collection $contacts;

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
