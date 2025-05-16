<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use RuntimeException;

final class Ares
{
    private const string URL = 'https://ares.gov.cz/ekonomicke-subjekty-v-be/rest/ekonomicke-subjekty/';

    /**
     * @return array{
     *     company: string,
     *     company_id: string,
     *     vat_id: string|null,
     *     address: string,
     *     city: string,
     *     zip: string,
     *     country: string,
     * }
     */
    public function findByCompanyId(string $companyId): array
    {
        if (empty($companyId)) {
            throw new InvalidArgumentException('Company ID cannot be empty');
        }

        /** @var array<string, mixed> $json */
        $json = Http::get(self::URL.$companyId)->json();

        if (! array_key_exists('sidlo', $json)) {
            throw new RuntimeException('Company could not be found.');
        }

        /** @var array<string, mixed> $headquarters */
        $headquarters = $json['sidlo'];

        $street = $headquarters['nazevUlice'] ?? $headquarters['nazevCastiObce'] ?? '';

        $houseNumber = is_string($headquarters['cisloDomovni']) ? $headquarters['cisloDomovni'] : '';
        $orientationNumber = is_string($headquarters['cisloOrientacni'] ?? null) ? $headquarters['cisloOrientacni'] : false;

        $houseNumber = $orientationNumber ? $houseNumber.'/'.$orientationNumber : $houseNumber;

        $address = mb_trim(implode(' ', [
            $street,
            $houseNumber,
        ]));

        return [
            'company' => is_string($json['obchodniJmeno']) ? $json['obchodniJmeno'] : '',
            'company_id' => is_string($json['ico']) ? $json['ico'] : '',
            'vat_id' => is_string($json['dic'] ?? null) ? $json['dic'] : null,
            'address' => $address,
            'city' => is_string($headquarters['nazevObce']) ? $headquarters['nazevObce'] : '',
            'zip' => is_numeric($headquarters['psc']) ? (string) $headquarters['psc'] : '',
            'country' => is_string($headquarters['kodStatu']) ? $headquarters['kodStatu'] : '',
        ];
    }
}
