<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class EnsureUserHasFilledBillingSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->company_id === null || $user->billing_company === null || $user->billing_address === null || $user->billing_city === null || $user->billing_zip === null || $user->billing_country === null) {
            return to_route('settings.billing')->withErrors([
                'company_id' => __('Billing settings have not been set up yet.'),
            ]);
        }

        return $next($request);
    }
}
