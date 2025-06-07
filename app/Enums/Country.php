<?php

declare(strict_types=1);

namespace App\Enums;

enum Country: string
{
    case CZECHIA = 'CZ';
    case SLOVAKIA = 'SK';

    public function label(): string
    {
        return match ($this) {
            self::CZECHIA => __('Czechia'),
            self::SLOVAKIA => __('Slovakia'),
        };
    }
}
