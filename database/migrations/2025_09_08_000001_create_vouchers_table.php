<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('discount_percent', ['10','20','30','50','80','100']);
            $table->enum('applicable_type', ['produk','event']);
            $table->unsignedBigInteger('applicable_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['applicable_type', 'applicable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};


