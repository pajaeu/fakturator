<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;

final class LogoutController
{
    public function __invoke(): RedirectResponse
    {
        auth()->logout();

        session()->invalidate();

        session()->regenerateToken();

        return to_route('login');
    }
}
