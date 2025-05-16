<?php

declare(strict_types=1);

use App\Enums\Currency;
use App\Support\Price;

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
