<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

use App\Models\Contact;

trait FillsContactFieldsFromContactModel
{
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
