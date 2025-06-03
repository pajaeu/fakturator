<?php

declare(strict_types=1);

use App\Enums\Currency;
use App\Models\Invoice;
use App\Support\Price;
use App\Support\QrPayment;

if (! function_exists('price')) {
    function price(float $amount, string|Currency $currency): Price
    {
        if ($currency instanceof Currency) {
            return new Price($amount, $currency);
        }

        $currency = Currency::tryFrom($currency);

        if ($currency === null) {
            $currency = Price::DEFAULT_CURRENCY;
        }

        return new Price($amount, $currency);
    }
}

if (! function_exists('invoice_qr_payment')) {
    function invoice_qr_payment(Invoice $invoice): QrPayment
    {
        if (! $invoice->bankAccount) {
            throw new InvalidArgumentException('Invoice bank account is required.');
        }

        return new QrPayment(
            $invoice->bankAccount->number,
            $invoice->bankAccount->bank_code,
            $invoice->total_with_vat,
            $invoice->currency->value,
            $invoice->variable_symbol ?? $invoice->number
        );
    }
}
