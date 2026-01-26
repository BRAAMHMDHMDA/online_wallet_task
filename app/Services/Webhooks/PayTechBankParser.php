<?php

namespace App\Services\Webhooks;

use App\Interfaces\BankParser;

class PayTechBankParser implements BankParser
{
    public function parse(string $payload): array
    {
        $lines = explode("\n", trim($payload));
        $transactions = [];

        foreach ($lines as $line) {
            [$dateAmount, $reference] = explode('#', $line);
            [$date, $amount] = explode(',', $dateAmount);

            $transactions[] = [
                'reference' => $reference,
                'amount' => $amount,
                'date' => $date,
            ];
        }

        return $transactions;
    }
}
