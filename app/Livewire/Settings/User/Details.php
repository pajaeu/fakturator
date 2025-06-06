<?php

declare(strict_types=1);

namespace App\Livewire\Settings\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class Details extends Component
{
    #[Locked]
    public User $user;

    public string $email = '';

    public function mount(): void
    {
        /** @var User $user */
        $user = auth()->user();

        $this->email = $user->email;
        $this->user = $user;
    }

    public function save(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->validate();

        $this->user->update($data);
    }

    public function delete(): void
    {
        $this->user->delete();

        auth()->logout();

        session()->invalidate();

        session()->regenerateToken();

        $this->redirectRoute('login', navigate: true);
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user->id),
            ],
        ];
    }

    public function render(): View
    {
        return view('livewire.settings.user.details');
    }
}
