<?php

declare(strict_types=1);

namespace App\Support;

final readonly class QrPayment
{
    private const string API_URL = 'https://api.paylibo.com/paylibo/generator/czech/image';

    public function __construct(
        public string $accountNumber,
        public string $bankCode,
        public float $amount,
        public string $currency,
        public string $variableSymbol,
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
