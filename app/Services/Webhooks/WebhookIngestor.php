<?php

namespace App\Services\Webhooks;

use App\Actions\Transactions;
use App\Enums\IncomingWebhookStatus;
use App\Models\IncomingWebhook;
use InvalidArgumentException;

class WebhookIngestor
{
    public function ingest(IncomingWebhook $webhook): void
    {

        try {
            $parser = match ($webhook->bank) {
                'paytech' => new PayTechBankParser(),
                'acme'    => new AcmeBankParser(),
                default   => throw new InvalidArgumentException("Unsupported bank: {$webhook->bank}"),
            };

            $transactions = $parser->parse($webhook->payload);

            foreach ($transactions as $transaction) {
                Transactions\StoreAction::execute($transaction);
            }
        } catch (\Throwable $e) {
            $webhook->update(['status' => IncomingWebhookStatus::Failed]);
            throw $e;
        }
    }
}

