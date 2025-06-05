<?php

declare(strict_types=1);

namespace App\View\Components\Dashboard;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\Component;

final class MonthlyIncomesChart extends Component
{
    public function render(): View
    {
        $labels = collect(range(1, 12))->map(function ($monthNumber) {
            return Str::ucfirst(__(now()->startOfYear()->month((int) $monthNumber)->translatedFormat('F')));
        });

        $data = Cache::remember('monthly_incomes_'.auth()->id(), 3600, function () {
            $data = DB::table('invoices')->selectRaw('DATE_FORMAT(issued_at, "%m") as month, SUM(total_with_vat) as total')
                ->where('user_id', auth()->id())
                ->whereYear('issued_at', now()->year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month');

            return collect(range(1, 12))->map(function ($month) use ($data) {
                $monthKey = mb_str_pad((string) $month, 2, '0', STR_PAD_LEFT);

                return $data[$monthKey] ?? 0;
            });
        });

        return view('components.dashboard.monthly-incomes-chart', [
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
