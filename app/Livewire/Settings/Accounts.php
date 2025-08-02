<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use App\Actions\GetSwiftCodeFromBankCode;
use App\Livewire\Concerns\CanPushNotifications;
use App\Models\BankAccount;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class Accounts extends Component
{
    use CanPushNotifications;

    public string $name = '';

    public string $number = '';

    public string $bank_code = '';

    public ?string $iban = null;

    public ?string $swift = null;

    public function updatedBankCode(string $value): void
    {
        $this->swift = GetSwiftCodeFromBankCode::handle($value);
    }

    #[On('open-account-create-modal')]
    #[On('close-account-create-modal')]
    public function resetCreateModal(): void
    {
        $this->reset('name', 'number', 'bank_code', 'iban', 'swift');

        $this->resetErrorBag(['name', 'number', 'bank_code', 'iban', 'swift']);
    }

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

        $this->pushNotification(__('Success'));
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

        $this->pushNotification(__('Success'));
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
