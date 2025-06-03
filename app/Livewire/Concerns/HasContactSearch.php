<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Locked;

trait HasContactSearch
{
    use FillsContactFieldsFromContactModel;

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
}
