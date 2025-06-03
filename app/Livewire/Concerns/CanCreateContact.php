<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

use App\Actions\Ares\GetCompanyDetailsFromCompanyId;
use App\Models\Contact;
use Exception;

trait CanCreateContact
{
    use FillsContactFieldsFromContactModel;

    public ?string $new_contact_company_id = null;

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
}
