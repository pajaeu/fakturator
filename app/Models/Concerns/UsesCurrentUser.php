<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Models\Scopes\CurrentUserScope;

trait UsesCurrentUser
{
    protected static function booted(): void
    {
        static::addGlobalScope(new CurrentUserScope());
    }
}
