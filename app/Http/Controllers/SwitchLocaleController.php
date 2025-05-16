<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

final class SwitchLocaleController
{
    public function __invoke(string $locale): RedirectResponse
    {
        /** @var array<int, string> $locales */
        $locales = config('app.available_locales');

        if (in_array($locale, $locales)) {
            session()->put('_locale', $locale);
        }

        return redirect()->back();
    }
}
