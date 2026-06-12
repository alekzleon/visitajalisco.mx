<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_type', 80)->index();
            $table->foreignId('zone_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('airbnb_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('business_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('public_ad_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('premium_service_id')->nullable()->constrained()->nullOnDelete();
            $table->string('destination')->nullable()->index();
            $table->string('code', 80)->nullable()->index();
            $table->string('target_url')->nullable();
            $table->string('url')->nullable();
            $table->string('referrer')->nullable();
            $table->string('ip_hash', 80)->nullable()->index();
            $table->string('user_agent', 500)->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('occurred_at')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_events');
    }
};
