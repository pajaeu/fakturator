<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Invoice;

final class GenerateLatestInvoiceNumber
{
    public static function handle(): string
    {
        $latestInvoice = Invoice::query()
            ->whereYear('issued_at', now()->year)
            ->whereMonth('issued_at', now()->month)
            ->latest('number')
            ->first();

        $invoiceCount = $latestInvoice ? ((int) mb_substr($latestInvoice->number, -4)) + 1 : 1;

        return sprintf('%d%02d%04d', now()->year, now()->month, $invoiceCount);
    }
}
