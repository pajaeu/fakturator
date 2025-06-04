<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\View\View;

final class DashboardController
{
    public function __invoke(): View
    {
        $invoices = Invoice::query()
            ->latest()
            ->limit(6)
            ->get();

        return view('dashboard', [
            'invoices' => $invoices,
        ]);
    }
}
