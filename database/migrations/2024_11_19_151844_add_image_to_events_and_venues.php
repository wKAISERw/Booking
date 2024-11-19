<?php

// database/migrations/add_image_to_events_and_venues.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('events', function (Blueprint $table) {
            $table->string('image')->nullable()->after('venue_id');
        });

        Schema::table('venues', function (Blueprint $table) {
            $table->string('image')->nullable()->after('capacity');
        });
    }

    public function down() {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('venues', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
