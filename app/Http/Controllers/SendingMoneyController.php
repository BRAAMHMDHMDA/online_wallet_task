<?php
namespace App\Http\Controllers;

use App\Services\SendingMoney\PaymentXmlBuilder;
use Illuminate\Support\Facades\Request;

class SendingMoneyController extends Controller
{
    public function __invoke(Request $request){

        $xml = PaymentXmlBuilder::build([
            'reference' => 'abc-123',
            'date' => now(),
            'amount' => 177.39,
            'currency' => 'SAR',
            'sender_account' => 'SA123',
            'bank_code' => 'FDCSSARI',
            'receiver_account' => 'SA999',
            'beneficiary' => 'Jane Doe',
            'notes' => ['Note 1', 'Note 2'],
            'payment_type' => 421,
            'charge_details' => 'RB',
        ]);

        echo $xml;

    }
}
