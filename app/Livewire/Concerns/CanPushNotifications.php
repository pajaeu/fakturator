<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

use App\Support\Notification;

trait CanPushNotifications
{
    public function pushNotification(string $message, string $type = Notification::SUCCESS): void
    {
        $this->dispatch('pushNotification', message: $message, type: $type);
    }
}
