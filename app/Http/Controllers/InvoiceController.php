<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;

final class InvoiceController
{
    public function print(Invoice $invoice): PdfBuilder
    {
        return $this->getPdf($invoice);
    }

    public function download(Invoice $invoice): PdfBuilder
    {
        return $this->getPdf($invoice)
            ->download();
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
        $pdf = Pdf::view('pdf.invoice', ['invoice' => $invoice])
            ->withBrowsershot(function (Browsershot $browsershot) {
                $browsershot
                    ->addChromiumArguments([
                        '--no-sandbox',
                    ]);
            });

        return $pdf->name($name);
    }
}
