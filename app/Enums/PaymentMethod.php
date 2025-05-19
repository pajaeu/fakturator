<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentMethod: string
{
    case BANK_TRANSFER = 'bank_transfer';
    case CASH = 'cash';
    case CREDIT_CARD = 'credit_card';

    public function label(): string
    {
        return match ($this) {
            self::BANK_TRANSFER => __('Bank Transfer'),
            self::CASH => __('Cash'),
            self::CREDIT_CARD => __('Credit Card'),
        };
    }
}
