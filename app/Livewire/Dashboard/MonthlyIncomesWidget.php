<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Livewire\Concerns\CanPushNotifications;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Livewire\Component;

final class MonthlyIncomesWidget extends Component
{
    use CanPushNotifications;

    public function resetData(): void
    {
        Cache::forget('monthly_incomes_'.auth()->id());

        $this->pushNotification(__('Recalculated'));

        $this->redirectRoute('dashboard', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.dashboard.monthly-incomes-widget');
    }
}
