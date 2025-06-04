<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Livewire\Component;

final class MonthlyIncomesWidget extends Component
{
    public function resetData(): void
    {
        Cache::forget('monthly_incomes_'.auth()->id());
    }

    public function render(): View
    {
        return view('livewire.dashboard.monthly-incomes-widget');
    }
}
