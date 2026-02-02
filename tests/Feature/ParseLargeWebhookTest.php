<?php
namespace Tests\Feature;

use App\Services\Webhooks\PayTechBankParser;
use Tests\TestCase;

class ParseLargeWebhookTest extends TestCase
{
    public function test_parser_can_handle_1000_transactions_with_good_performance()
    {
        $parser = new PayTechBankParser();

        // توليد Payload فيه 1000 transaction
        $payloadLines = [];

        for ($i = 1; $i <= 1000; $i++) {
            $payloadLines[] = "20250615,100.00#TX{$i}";
        }

        $payload = implode("\n", $payloadLines);

        $start = microtime(true);

        $transactions = $parser->parse($payload);

        $duration = microtime(true) - $start;

        // Assertions
        $this->assertCount(1000, $transactions);

        // زمن التنفيذ يجب أن يكون مقبولًا
        $this->assertLessThan(
            0.2,
            $duration,
            "Parsing 1000 transactions took too long: {$duration} seconds"
        );
    }
}
