<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('instagram_username')->nullable()->after('whatsapp');
            $table->string('facebook_username')->nullable()->after('instagram_username');
            $table->string('tiktok_username')->nullable()->after('facebook_username');
        });
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn(['instagram_username', 'facebook_username', 'tiktok_username']);
        });
    }
};
