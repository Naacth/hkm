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
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumn(['participant_prodi', 'participant_jenjang', 'participant_whatsapp', 'participant_alamat']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->string('participant_prodi')->nullable()->after('participant_kelas');
            $table->string('participant_jenjang')->nullable()->after('participant_prodi');
            $table->string('participant_whatsapp')->nullable()->after('participant_email');
            $table->text('participant_alamat')->nullable()->after('participant_whatsapp');
        });
    }
};
