<?php

declare(strict_types=1);

namespace App\Enums;

enum UserTier: string
{
    case FREE = 'free';
    case PRO = 'pro';

    public function label(): string
    {
        return match ($this) {
            self::FREE => 'Free',
            self::PRO => 'Pro',
        };
    }
}
