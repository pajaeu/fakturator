<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Actions\Ares\GetCompanyDetailsFromCompanyId;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Models\Contact;
use Exception;
use Illuminate\Database\Query\Builder;
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

    public function updatedCompanyId(string $value): void
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
            'country' => 'required|string|size:2',
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
