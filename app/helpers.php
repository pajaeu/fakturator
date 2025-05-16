<?php

declare(strict_types=1);

use App\Enums\Currency;
use App\Support\Price;

if (! function_exists('price')) {
    function price(float $amount, string|Currency $currency): Price
    {
        if (is_string($currency)) {
            $currency = Currency::from($currency);
        }

        return new Price($amount, $currency);
    }
}
