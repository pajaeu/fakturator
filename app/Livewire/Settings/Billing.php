<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use App\Actions\Ares\GetCompanyDetailsFromCompanyId;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Models\User;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Billing extends Component
{
    use ResetsValidationAfterUpdate;

    public User $user;

    public string $company_id = '';

    public ?string $vat_id = null;

    public string $billing_company = '';

    public string $billing_address = '';

    public string $billing_city = '';

    public string $billing_country = '';

    public string $billing_zip = '';

    public function mount(): void
    {
        /** @var User $user */
        $user = auth()->user();

        $this->company_id = $user->company_id ?? '';
        $this->vat_id = $user->vat_id;
        $this->billing_company = $user->billing_company ?? '';
        $this->billing_address = $user->billing_address ?? '';
        $this->billing_city = $user->billing_city ?? '';
        $this->billing_country = $user->billing_country->value ?? '';
        $this->billing_zip = $user->billing_zip ?? '';
        $this->user = $user;
    }

    public function updatedCompanyId(string $value): void
    {
        try {
            $data = GetCompanyDetailsFromCompanyId::handle($value);

            $this->company_id = $data['company_id'];
            $this->vat_id = $data['vat_id'];
            $this->billing_company = $data['company'];
            $this->billing_address = $data['address'];
            $this->billing_city = $data['city'];
            $this->billing_country = $data['country'];
            $this->billing_zip = $data['zip'];
        } catch (Exception) {
            $this->addError('company_id', __('Company details could not be found.'));
        }
    }

    public function save(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        $this->user->update($data);
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'company_id' => [
                'required',
                'digits:8',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'vat_id' => Rule::when($this->vat_id !== null, 'string|min:10|max:12'),
            'billing_company' => 'required|string|min:3|max:255',
            'billing_address' => 'required|string|min:3|max:255',
            'billing_city' => 'required|string|min:2|max:255',
            'billing_country' => 'required|string|size:2',
            'billing_zip' => 'required|string|min:5|max:255',
        ];
    }

    public function render(): View
    {
        return view('livewire.settings.billing');
    }
}
