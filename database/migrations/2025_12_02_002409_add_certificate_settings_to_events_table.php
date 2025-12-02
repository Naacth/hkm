<?php

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
        Schema::table('events', function (Blueprint $table) {
            $table->integer('cert_x')->nullable()->after('certificate_template');
            $table->integer('cert_y')->nullable()->after('cert_x');
            $table->integer('cert_font_size')->nullable()->after('cert_y');
            $table->string('cert_color', 7)->nullable()->default('#000000')->after('cert_font_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['cert_x', 'cert_y', 'cert_font_size', 'cert_color']);
        });
    }
};
