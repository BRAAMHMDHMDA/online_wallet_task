<?php
namespace App\Services\Webhooks;

 use App\Interfaces\BankParser;
 use InvalidArgumentException;

class BankParserFactory
{
     public static function make(string $bank): BankParser
     {
         return match ($bank) {
             'paytech' => new PayTechBankParser(),
             'acme'    => new AcmeBankParser(),
             default   => throw new InvalidArgumentException("Unsupported bank: {$bank}"),
         };
     }
}
