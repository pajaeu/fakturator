<?php

declare(strict_types=1);

namespace App\Enums;

enum Country: string
{
    case CZECH = 'CZ';
    case SLOVAKIA = 'SK';

    public function label(): string
    {
        return match ($this) {
            self::CZECH => __('Czech'),
            self::SLOVAKIA => __('Slovakia'),
        };
    }
}
