<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use App\Models\BankAccount;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

final class Accounts extends Component
{
    public string $name = '';

    public string $number = '';

    public string $bank_code = '';

    public ?string $iban = null;

    public ?string $swift = null;

    public function addNewAccount(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        $default = ! BankAccount::query()->where('default', true)->exists();

        BankAccount::query()->create([
            ...$data,
            'default' => $default,
            'user_id' => auth()->id(),
        ]);

        $this->dispatch('close-account-create-modal');
    }

    public function setAsDefault(int $accountId): void
    {
        $account = BankAccount::query()->find($accountId);

        if (! $account) {
            return;
        }

        BankAccount::query()
            ->whereNot('id', $accountId)
            ->update([
                'default' => false,
            ]);

        $account->update([
            'default' => true,
        ]);
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'number' => 'required|string|min:10|max:17',
            'bank_code' => 'required|string|size:4',
            'iban' => Rule::when($this->iban !== null, 'string'),
            'swift' => Rule::when($this->swift !== null, 'string'),
        ];
    }

    public function render(): View
    {
        return view('livewire.settings.accounts', [
            'accounts' => BankAccount::query()->latest()->paginate(10),
        ]);
    }
}
