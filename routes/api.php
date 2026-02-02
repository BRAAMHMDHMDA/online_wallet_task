<?php

use App\Http\Controllers\SendingMoneyController;
use App\Http\Controllers\TransactionWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/transactionWebhook/{bank}',TransactionWebhookController::class)
    ->name('transactionWebhook.store');

Route::post('/sendingMoney',SendingMoneyController::class)
    ->name('sendingMoney');
