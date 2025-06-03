<?php

declare(strict_types=1);

namespace App\Livewire\Contacts\Concerns;

use App\Actions\Ares\GetCompanyDetailsFromCompanyId;
use Exception;

trait CreatesUpdatesContact
{
    public string $company_id = '';

    public ?string $vat_id = null;

    public string $name = '';

    public string $address = '';

    public string $city = '';

    public string $country = '';

    public string $zip = '';

    public ?string $phone = null;

    public ?string $email = null;

    public function loadDetailsFromCompanyId(string $value): void
    {
        try {
            $data = GetCompanyDetailsFromCompanyId::handle($value);

            $this->company_id = $data['company_id'];
            $this->vat_id = $data['vat_id'];
            $this->name = $data['company'];
            $this->address = $data['address'];
            $this->city = $data['city'];
            $this->country = $data['country'];
            $this->zip = $data['zip'];
        } catch (Exception) {
            $this->addError('company_id', __('Company details could not be found.'));
        }
    }
}
