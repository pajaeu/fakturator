<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Throwable;

final class InvoiceController
{
    public function print(Invoice $invoice): Response|RedirectResponse
    {
        try {
            return $this->getPdf($invoice)
                ->stream($this->generateInvoiceName($invoice));
        } catch (Throwable) {
            return redirect()->back()->with('error', __('Invoice failed to generate.'));
        }
    }

    public function download(Invoice $invoice): Response|RedirectResponse
    {
        try {
            return $this->getPdf($invoice)
                ->download($this->generateInvoiceName($invoice));
        } catch (Throwable) {
            return redirect()->back()->with('error', __('Invoice failed to generate.'));
        }
    }

    private function getPdf(Invoice $invoice): \Barryvdh\DomPDF\PDF
    {
        return Pdf::loadView('pdf.invoice-inline', ['invoice' => $invoice]);
    }

    private function generateInvoiceName(Invoice $invoice): string
    {
        return Str::of(implode('-', [
            $invoice->number,
            now()->format('d-m-Y'),
        ]))
            ->lower()
            ->slug()
            ->toString().'.pdf';
    }
}
