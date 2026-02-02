<?php
namespace App\Services\SendingMoney;

use SimpleXMLElement;

class PaymentXmlBuilder
{
    public static function build(array $data): string
    {
        $xml = new SimpleXMLElement(
            '<?xml version="1.0" encoding="utf-8"?><PaymentRequestMessage/>'
        );

        $transfer = $xml->addChild('TransferInfo');
        $transfer->addChild('Reference', $data['reference']);
        $transfer->addChild('Date', $data['date']);
        $transfer->addChild('Amount', $data['amount']);
        $transfer->addChild('Currency', $data['currency']);

        $sender = $xml->addChild('SenderInfo');
        $sender->addChild('AccountNumber', $data['sender_account']);

        $receiver = $xml->addChild('ReceiverInfo');
        $receiver->addChild('BankCode', $data['bank_code']);
        $receiver->addChild('AccountNumber', $data['receiver_account']);
        $receiver->addChild('BeneficiaryName', $data['beneficiary']);

        if (!empty($data['notes'])) {
            $notes = $xml->addChild('Notes');
            foreach ($data['notes'] as $note) {
                $notes->addChild('Note', $note);
            }
        }

        if ($data['payment_type'] !== 99) {
            $xml->addChild('PaymentType', $data['payment_type']);
        }

        if ($data['charge_details'] !== 'SHA') {
            $xml->addChild('ChargeDetails', $data['charge_details']);
        }

        return $xml->asXML();
    }
}
