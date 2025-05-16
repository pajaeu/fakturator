<?php

declare(strict_types=1);

namespace App\Actions\Ares;

use App\Services\Ares;

final class GetCompanyDetailsFromCompanyId
{
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
    public static function handle(string $companyId): array
    {
        /** @var Ares $ares */
        $ares = app(Ares::class);

        return $ares->findByCompanyId($companyId);
    }
}
