<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

final class Vies
{
    private const string BASE_URL = 'https://vat.erply.com/numbers';

    public function validate(string $vatId): bool
    {
        try {
            $vatId = Str::upper($vatId);

            /** @var array<string, mixed> $response */
            $response = Http::acceptJson()
                ->get(self::BASE_URL.'?'.http_build_query([
                    'vatNumber' => $vatId,
                ]))
                ->throw()
                ->json();

            return is_bool($response['Valid']) ? $response['Valid'] : (bool) $response['Valid'];
        } catch (Exception) {
            return false;
        }
    }
}
