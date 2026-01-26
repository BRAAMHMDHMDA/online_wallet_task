<?php

namespace App\Enums;

enum IncomingWebhookStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Success = 'success';
    case Failed = 'failed';
}
