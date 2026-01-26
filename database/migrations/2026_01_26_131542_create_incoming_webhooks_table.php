<?php

use App\Enums\IncomingWebhookStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incoming_webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('bank');
            $table->text('payload');
            $table->enum('status', [IncomingWebhookStatus::Pending,
                IncomingWebhookStatus::Processing,
                IncomingWebhookStatus::Success,
                IncomingWebhookStatus::Failed,])
                ->default(IncomingWebhookStatus::Pending);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_webhooks');
    }
};
