<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    public ?string $company_id = null;

    public ?string $vat_id = null;

    public ?string $name = null;

    public ?string $address = null;

    public ?string $city = null;

    public ?string $country = null;

    public ?string $zip = null;

    public ?string $phone = null;

    public ?string $email = null;

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'company_id' => [
                'required',
                'digits:8',
                Rule::unique('contacts')->where(fn (Builder $query) => $query->where('user_id', auth()->id())),
            ],
            'vat_id' => Rule::when($this->vat_id !== null, [
                'string',
                'min:10',
                'max:12',
            ]),
            'name' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],
            'city' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],
            'country' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],
            'zip' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'phone' => Rule::when($this->phone !== null, [
                'string',
                'min:6',
            ]),
            'email' => Rule::when($this->email !== null, [
                'email',
            ]),
        ];
    }

    public function updated(string $property): void
    {
        $this->validateOnly($property);

        $this->resetErrorBag($property);
    }

    public function updatedCompanyId(): void
    {
        // todo get data from ares
    }

    public function save(): void
    {
        $this->validate();

        /** @var array<string, mixed> $data */
        $data = $this->all();

        Contact::query()->create($data + ['user_id' => auth()->id()]);

        // todo redirect to contact detail
    }

    public function render(): View
    {
        return view('livewire.contacts.create');
    }
}
