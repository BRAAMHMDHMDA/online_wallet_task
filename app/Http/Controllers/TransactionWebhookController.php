<?php

namespace App\Http\Controllers;

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

        return Response::json([
            'status' => 'webhook received successfully',
        ]);
    }
}
