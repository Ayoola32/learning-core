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
            $table->string('invoice_id')->unique();
            $table->foreignId('buyer_id')->constrained('users');
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->double('total_amount');
            $table->string('currency')->default('USD');
            $table->double('paid_amount')->nullable();
            $table->boolean('has_token')->default(false);
            $table->string('coupon_code')->nullable();
            $table->double('coupon_discount')->default(0);
            $table->string('transaction_id')->unique()->nullable();
            $table->string('payment_method')->nullable();
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
