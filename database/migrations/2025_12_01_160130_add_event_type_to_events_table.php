<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->enum('event_type', ['free', 'paid', 'public'])->default('free')->after('status');
        });

        // Migrate existing data based on is_paid field
        DB::table('events')->where('is_paid', 0)->update(['event_type' => 'free']);
        DB::table('events')->where('is_paid', 1)->update(['event_type' => 'paid']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('event_type');
        });
    }
};
