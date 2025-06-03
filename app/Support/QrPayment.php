<?php

declare(strict_types=1);

namespace App\Support;

final class QrPayment
{
    private const API_URL = 'https://api.paylibo.com/paylibo/generator/czech/image';

    public function __construct(
        public readonly string $accountNumber,
        public readonly string $bankCode,
        public readonly float $amount,
        public readonly string $currency,
        public readonly string $variableSymbol,
    ) {}

    public function render(): string
    {
        $url = self::API_URL.'?'.$this->getQueryString();

        return sprintf('<img src="%s" width="%d" alt="%s">', $url, 160, __('QR payment'));
    }

    private function getQueryString(): string
    {
        return http_build_query([
            'accountNumber' => $this->accountNumber,
            'bankCode' => $this->bankCode,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'vs' => $this->variableSymbol,
        ]);
    }
}
