<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('maps_url')->nullable()->after('whatsapp');
        });

        Schema::table('airbnbs', function (Blueprint $table) {
            $table->dropColumn('maps_url');
        });
    }

    public function down(): void
    {
        Schema::table('airbnbs', function (Blueprint $table) {
            $table->string('maps_url')->nullable()->after('airbnb_url');
        });

        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('maps_url');
        });
    }
};
