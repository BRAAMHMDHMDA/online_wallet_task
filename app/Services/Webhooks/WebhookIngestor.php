<?php

namespace App\Services\Webhooks;

use App\Actions\Transactions;
use App\Enums\IncomingWebhookStatus;
use App\Models\IncomingWebhook;

class WebhookIngestor
{
    public function ingest(IncomingWebhook $webhook): void
    {

        try {
            $parser = BankParserFactory::make($webhook->bank);
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

