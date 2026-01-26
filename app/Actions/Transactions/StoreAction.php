<?php
namespace App\Actions\Transactions;

use App\Models\Transaction;

class StoreAction
{
    public static function execute(array $data): void
    {
        Transaction::firstOrCreate(
            ['reference' => $data['reference']],
            [
                'amount' => $data['amount'],
                'transaction_date' => $data['date'],
                'client_id' => $data['client_id'] ?? 1,
            ]
        );
    }
}
