<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'reference';
    protected $fillable = [
        'reference',
        'amount',
        'transaction_date',
        'client_id',
    ];
}
