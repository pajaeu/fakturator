<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;
use Throwable;

final class InvoiceController
{
    public function print(Request $request, Invoice $invoice): Response|RedirectResponse
    {
        try {
            return $this->getPdf($invoice)
                ->toResponse($request);
        } catch (Throwable) {
            return redirect()->back()->with('error', __('Invoice failed to generate.'));
        }
    }

    public function download(Request $request, Invoice $invoice): Response|RedirectResponse
    {
        try {
            return $this->getPdf($invoice)
                ->download()
                ->toResponse($request);
        } catch (Throwable) {
            return redirect()->back()->with('error', __('Invoice failed to generate.'));
        }
    }

    private function getPdf(Invoice $invoice): PdfBuilder
    {
        $name = Str::of(implode('-', [
            $invoice->number,
            now()->format('d-m-Y'),
        ]))
            ->lower()
            ->slug()
            ->toString();

        /** @var PdfBuilder $pdf */
        $pdf = Pdf::view('pdf.invoice', ['invoice' => $invoice]);

        return $pdf->name($name);
    }
}
