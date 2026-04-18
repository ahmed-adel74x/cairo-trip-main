<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('places', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable()->after('location_en');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->enum('category', ['attraction', 'restaurant', 'hotel'])
                  ->default('attraction')
                  ->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'category']);
        });
    }
};