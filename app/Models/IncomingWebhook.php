<?php

namespace App\Models;

use App\Enums\IncomingWebhookStatus;
use Illuminate\Database\Eloquent\Model;

class IncomingWebhook extends Model
{
    protected $casts = [
        'status' => IncomingWebhookStatus::class,
    ];

    protected $fillable = [
        'bank',
        'payload',
        'status'
    ];
}
