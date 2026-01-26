<?php

namespace App\Services\Webhooks;

use App\Actions\Transactions;
use App\Models\IncomingWebhook;
use InvalidArgumentException;

class WebhookIngestor
{
    public function ingest(IncomingWebhook $webhook): void
    {
        $parser = match ($webhook->bank) {
            'paytech' => new PayTechBankParser(),
            'acme'    => new AcmeBankParser(),
            default   => throw new InvalidArgumentException('Unsupported bank'),
        };

        $transactions = $parser->parse($webhook->payload);

        foreach ($transactions as $transaction) {
            Transactions\StoreAction::execute($transaction);
        }
    }
}

