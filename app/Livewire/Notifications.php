<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Support\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class Notifications extends Component
{
    /** @var Collection<string, Notification|mixed> */
    public Collection $notifications;

    public function mount(): void
    {
        $this->notifications = collect();
    }

    #[On('pushNotification')]
    public function pushNotification(string $message, string $type = Notification::SUCCESS): void
    {
        $uuid = Str::uuid()
            ->toString();

        $this->notifications->put($uuid, new Notification($uuid, $message, $type));
    }

    public function removeNotification(string $id): void
    {
        $this->notifications->offsetUnset($id);
    }

    public function render(): View
    {
        return view('livewire.notifications');
    }
}
