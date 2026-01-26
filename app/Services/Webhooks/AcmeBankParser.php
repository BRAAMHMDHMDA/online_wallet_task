<?php

namespace App\Services\Webhooks;

use App\Interfaces\BankParser;

class AcmeBankParser implements BankParser
{
    public function parse(string $payload): array
    {
        $lines = explode("\n", trim($payload));
        $transactions = [];

        foreach ($lines as $line) {
            [$amount, $reference, $date] = explode('//', $line);

            $transactions[] = [
                'reference' => $reference,
                'amount' => $amount,
                'date' => $date,
            ];
        }

        return $transactions;
    }
}
