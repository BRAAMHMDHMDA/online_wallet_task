<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessWebhookJob;
use App\Models\IncomingWebhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TransactionWebhookController extends Controller
{
    public function __invoke(Request $request,string $bank){
        IncomingWebhook::create([
            'bank' => $bank,
            'payload' => $request->getContent(),
        ]);

        // process the webhooks
        ProcessWebhookJob::dispatch();

        return Response::json([
            'status' => 'webhook received successfully',
        ]);
    }
}
