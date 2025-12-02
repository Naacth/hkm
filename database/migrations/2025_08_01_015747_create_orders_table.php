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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('produk_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 12, 2);
            $table->enum('payment_method', ['qris', 'offline'])->default('offline');
            $table->enum('delivery_method', ['pickup', 'delivery'])->default('pickup');
            $table->enum('status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_nim')->nullable();
            $table->string('customer_kelas')->nullable();
            $table->string('customer_email');
            $table->text('customer_address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
