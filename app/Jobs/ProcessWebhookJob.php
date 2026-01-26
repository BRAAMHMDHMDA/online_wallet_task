<?php

namespace App\Jobs;

use App\Enums\IncomingWebhookStatus;
use App\Models\IncomingWebhook;
use App\Services\Webhooks\WebhookIngestor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessWebhookJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(WebhookIngestor $ingestor): void
    {
        IncomingWebhook::where('status', 'pending')
            ->each(function ($webhook) use ($ingestor) {

                $ingestor->ingest($webhook);

                $webhook->update(['status' => IncomingWebhookStatus::Success]);
            });
    }
}
