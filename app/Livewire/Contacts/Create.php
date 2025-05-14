<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class Create extends Component
{
    #[Validate('required|digits:8')]
    public ?string $company_id = null;

    public ?string $vat_id = null;

    #[Validate('required|string|min:6|max:255')]
    public ?string $name = null;

    #[Validate('required|string|min:6|max:255')]
    public ?string $address = null;

    #[Validate('required|string|min:6|max:255')]
    public ?string $city = null;

    #[Validate('required|string|min:6|max:255')]
    public ?string $country = null;

    #[Validate('required|string|min:5|max:255')]
    public ?string $zip = null;

    #[Validate('string|min:6|nullable')]
    public ?string $phone = null;

    #[Validate('email|nullable')]
    public ?string $email = null;

    public function updatedCompanyId()
    {
        // todo get data from ares
    }

    public function save(): void
    {
        $this->validate();

        /** @var array<string, mixed> $data */
        $data = $this->all();

        Contact::query()->create($data);

        // todo redirect to contact detail
    }

    public function render(): View
    {
        return view('livewire.contacts.create');
    }
}
