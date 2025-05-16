<?php

declare(strict_types=1);

namespace App\Support;

final class Price
{
    public function __construct(
        private float $amount,
        private string $currencySymbol
    ) {}

    public function format(): string
    {
        return number_format($this->amount, 2, ',', ' ').' '.$this->currencySymbol;
    }
}
