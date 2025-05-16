<?php

declare(strict_types=1);

use App\Support\Price;

if (! function_exists('price')) {
    function price(float $amount, string $currencySymbol): Price
    {
        return new Price($amount, $currencySymbol);
    }
}
