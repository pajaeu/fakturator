<?php

declare(strict_types=1);

namespace App\Actions;

final class GetSwiftCodeFromBankCode
{
    public static function handle(string $bankCode): ?string
    {
        $map = [
            '0100' => 'KOMBCZPP',
            '0300' => 'CEKOCZPP',
            '0600' => 'AGBACZPP',
            '0710' => 'CNBACZPP',
            '0800' => 'GIBACZPX',
            '2010' => 'FIOBCZPP',
            '2020' => 'BOTKCZPP',
            '2060' => 'CITFCZPP',
            '2070' => 'MPUBCZPP',
            '2100' => null,
            '2200' => null,
            '2220' => 'ARTTCZPP',
            '2250' => 'CTASCZ22',
            '2260' => null,
            '2275' => null,
            '2600' => 'CITICZPX',
            '2700' => 'BACXCZPP',
            '3030' => 'AIRACZPP',
            '3050' => 'BPPF CZ P1',
            '3060' => 'BPKO CZ PP',
            '3500' => 'INGBCZPP',
            '4000' => 'EXPNCZPP',
            '4300' => 'CMZRCZP1',
            '5500' => 'RZBCCZPP',
            '5800' => 'JTBPCZPP',
            '6000' => 'PMBPCZPP',
            '6100' => 'EQBKCZPP',
            '6200' => 'COBACZPX',
            '6210' => 'BREXCZPP',
            '6300' => 'GEBACZPP',
            '6700' => 'SUBACZPP',
            '7910' => 'DEUTCZPX',
            '7950' => null,
            '7960' => null,
            '7970' => null,
            '7990' => null,
            '8030' => 'GENOCZ21',
            '8040' => 'OBKLCZ2X',
            '8060' => null,
            '8090' => 'CZEECZPP',
            '8150' => 'MIDLCZPP',
            '8190' => null,
            '8198' => 'FFCSCZP1',
            '8199' => 'MOUSCZP2',
            '8200' => null,
            '8220' => 'PAERCZP1',
            '8230' => null,
            '8240' => null,
            '8250' => 'BEORCZP2',
            '8255' => 'COMMCZPP',
            '8265' => 'ICBKCZPP',
            '8270' => 'FAPOCZP1',
            '8280' => 'BEFKCZP1',
            '8293' => 'MRPSCZPP',
            '8500' => null,
        ];

        return $map[$bankCode] ?? null;
    }
}
