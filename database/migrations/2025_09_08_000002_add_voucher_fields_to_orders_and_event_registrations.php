<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Orders table - add columns if they don't exist
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'voucher_code')) {
                $table->string('voucher_code')->nullable()->after('total_price');
            }
            if (!Schema::hasColumn('orders', 'voucher_discount_percent')) {
                $table->unsignedTinyInteger('voucher_discount_percent')->nullable()->after('voucher_code');
            }
            if (!Schema::hasColumn('orders', 'discount_amount')) {
                $table->decimal('discount_amount', 12, 2)->default(0)->after('voucher_discount_percent');
            }
            if (!Schema::hasColumn('orders', 'final_price')) {
                $table->decimal('final_price', 12, 2)->nullable()->after('discount_amount');
            }
        });

        // Event registrations - add columns if they don't exist
        Schema::table('event_registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('event_registrations', 'voucher_code')) {
                $table->string('voucher_code')->nullable()->after('notes');
            }
            if (!Schema::hasColumn('event_registrations', 'voucher_discount_percent')) {
                $table->unsignedTinyInteger('voucher_discount_percent')->nullable()->after('voucher_code');
            }
            if (!Schema::hasColumn('event_registrations', 'discount_amount')) {
                $table->decimal('discount_amount', 12, 2)->default(0)->after('voucher_discount_percent');
            }
            if (!Schema::hasColumn('event_registrations', 'final_price')) {
                $table->decimal('final_price', 12, 2)->nullable()->after('discount_amount');
            }
            if (!Schema::hasColumn('event_registrations', 'payment_method')) {
                $table->enum('payment_method', ['qris', 'offline'])->default('offline')->after('final_price');
            }
            if (!Schema::hasColumn('event_registrations', 'payment_status')) {
                $table->enum('payment_status', ['pending','paid','failed'])->default('pending')->after('payment_method');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['voucher_code','voucher_discount_percent','discount_amount','final_price']);
        });

        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumn(['voucher_code','voucher_discount_percent','discount_amount','final_price','payment_method','payment_status']);
        });
    }
};


