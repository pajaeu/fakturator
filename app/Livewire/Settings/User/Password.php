<?php

declare(strict_types=1);

namespace App\Livewire\Settings\User;

use App\Livewire\Concerns\CanPushNotifications;
use App\Livewire\Concerns\ResetsValidationAfterUpdate;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class Password extends Component
{
    use CanPushNotifications;
    use ResetsValidationAfterUpdate;

    #[Locked]
    public User $user;

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(): void
    {
        /** @var User $user */
        $user = auth()->user();

        $this->user = $user;
    }

    public function save(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        $this->user->update($data);

        $this->pushNotification(__('Success'));

        $this->resetExcept('user');
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'password' => ['required', 'string', \Illuminate\Validation\Rules\Password::default(), 'confirmed'],
        ];
    }

    public function render(): View
    {
        return view('livewire.settings.user.password');
    }
}
