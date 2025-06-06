<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Enums\Country;
use App\Livewire\Concerns\CanPushNotifications;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Livewire\Contacts\Concerns\CreatesUpdatesContact;
use App\Models\Contact;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Edit extends Component
{
    use CanPushNotifications;
    use CreatesUpdatesContact;
    use ResetsValidationAfterUpdate;

    public Contact $contact;

    public function mount(Contact $contact): void
    {
        $this->contact = $contact;

        $this->fill($this->contact);
    }

    public function updatedCompanyId(string $value): void
    {
        $this->loadDetailsFromCompanyId($value);
    }

    public function save(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        $this->contact->update($data);

        $this->pushNotification(__('Success'));

        $this->redirectRoute('contacts.index', navigate: true);
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'company_id' => [
                'required',
                'digits:8',
                Rule::unique('contacts')->where(fn (Builder $query) => $query->where('user_id', auth()->id()))->ignore($this->contact->id),
            ],
            'vat_id' => Rule::when($this->vat_id !== null, 'string|min:10|max:12'),
            'name' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:3|max:255',
            'city' => 'required|string|min:2|max:255',
            'country' => [
                'required',
                Rule::in(Country::cases()),
            ],
            'zip' => 'required|string|min:5|max:255',
            'phone' => Rule::when($this->phone !== null, 'string|min:6'),
            'email' => Rule::when($this->email !== null, 'email'),
        ];
    }

    public function render(): View
    {
        return view('livewire.contacts.edit');
    }
}
