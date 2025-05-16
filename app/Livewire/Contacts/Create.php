<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Models\Contact;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    use ResetsValidationAfterUpdate;

    public string $company_id = '';

    public ?string $vat_id = null;

    public string $name = '';

    public string $address = '';

    public string $city = '';

    public string $country = '';

    public string $zip = '';

    public ?string $phone = null;

    public ?string $email = null;

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'company_id' => 'required|digits:8|unique:contacts,company_id,NULL,id,user_id,'.auth()->id(),
            'vat_id' => Rule::when($this->vat_id !== null, 'string|min:10|max:12'),
            'name' => 'required|string|min:6|max:255',
            'address' => 'required|string|min:6|max:255',
            'city' => 'required|string|min:6|max:255',
            'country' => 'required|string|min:6|max:255',
            'zip' => 'required|string|min:5|max:255',
            'phone' => Rule::when($this->phone !== null, 'string|min:6'),
            'email' => Rule::when($this->email !== null, 'email'),
        ];
    }

    public function updatedCompanyId(): void
    {
        // todo get data from ares
    }

    public function save(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        Contact::query()->create($data + ['user_id' => auth()->id()]);

        // todo redirect to contact detail
    }

    public function render(): View
    {
        return view('livewire.contacts.create');
    }
}
