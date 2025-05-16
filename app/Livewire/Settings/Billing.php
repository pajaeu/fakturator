<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Billing extends Component
{
    use ResetsValidationAfterUpdate;

    public User $user;

    public ?string $company_id = null;

    public ?string $vat_id = null;

    public ?string $billing_company = null;

    public ?string $billing_address = null;

    public ?string $billing_city = null;

    public ?string $billing_country = null;

    public ?string $billing_zip = null;

    public function mount(): void
    {
        /** @var User $user */
        $user = auth()->user();

        $this->company_id = $user->company_id;
        $this->vat_id = $user->vat_id;
        $this->billing_company = $user->billing_company;
        $this->billing_address = $user->billing_address;
        $this->billing_city = $user->billing_city;
        $this->billing_country = $user->billing_country;
        $this->billing_zip = $user->billing_zip;
        $this->user = $user;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'company_id' => 'required|digits:8|unique:contacts,company_id,NULL,id,user_id,'.auth()->id(),
            'vat_id' => Rule::when($this->vat_id !== null, 'string|min:10|max:12'),
            'billing_company' => 'required|string|min:6|max:255',
            'billing_address' => 'required|string|min:6|max:255',
            'billing_city' => 'required|string|min:6|max:255',
            'billing_country' => 'required|string|min:6|max:255',
            'billing_zip' => 'required|string|min:5|max:255',
        ];
    }

    public function save(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        $this->user->update($data);
    }

    public function render(): View
    {
        return view('livewire.settings.billing');
    }
}
