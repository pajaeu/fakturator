<?php

declare(strict_types=1);

namespace App\Enums;

enum Currency: string
{
    case USD = 'USD';
    case EUR = 'EUR';
    case GBP = 'GBP';
    case JPY = 'JPY';
    case AUD = 'AUD';
    case CAD = 'CAD';
    case CHF = 'CHF';
    case CNY = 'CNY';
    case SEK = 'SEK';
    case CZK = 'CZK';

    public function symbol(): string
    {
        return match ($this) {
            self::USD => '$',
            self::EUR => '€',
            self::GBP => '£',
            self::JPY => '¥',
            self::AUD => 'A$',
            self::CAD => 'C$',
            self::CHF => 'CHF',
            self::CNY => '¥',
            self::SEK => 'kr',
            self::CZK => 'Kč',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::USD => __('US Dollar'),
            self::EUR => __('Euro'),
            self::GBP => __('British Pound'),
            self::JPY => __('Japanese Yen'),
            self::AUD => __('Australian Dollar'),
            self::CAD => __('Canadian Dollar'),
            self::CHF => __('Swiss Franc'),
            self::CNY => __('Chinese Yuan'),
            self::SEK => __('Swedish Krona'),
            self::CZK => __('Czech Koruna'),
        };
    }

    public function format(float $amount): string
    {
        return match ($this) {
            self::USD, self::AUD, self::CAD, self::GBP => sprintf('%s%s', $this->symbol(), number_format($amount, 2, ',', ' ')),
            self::EUR, self::CHF, self::CNY, self::SEK, self::CZK => sprintf('%s %s', number_format($amount, 2, ',', ' '), $this->symbol()),
            self::JPY => sprintf('%s%s', $this->symbol(), number_format($amount, 0, ',', ' ')),
        };
    }
}
