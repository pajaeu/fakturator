<?php

declare(strict_types=1);

namespace App\Support;

use App\Enums\Currency;

final readonly class Price
{
    public const Currency DEFAULT_CURRENCY = Currency::CZK;

    public function __construct(
        private float $amount,
        private Currency $currency
    ) {}

    public function format(): string
    {
        return $this->currency->format($this->amount);
    }
}
