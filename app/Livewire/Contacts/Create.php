<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Enums\Country;
use App\Livewire\Concerns\CreatesUpdatesContact;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Models\Contact;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    use CreatesUpdatesContact;
    use ResetsValidationAfterUpdate;

    public bool $otherDataFilled = false;

    public function updatedCompanyId(): void
    {
        $this->otherDataFilled = true;
    }

    public function save(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        Contact::query()->create([
            ...$data,
            'user_id' => auth()->id(),
        ]);

        $this->redirectRoute('contacts.index', navigate: true);
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'company_id' => [
                'required',
                'digits:8',
                Rule::unique('contacts')->where(fn (Builder $query) => $query->where('user_id', auth()->id())),
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
        return view('livewire.contacts.create');
    }
}
