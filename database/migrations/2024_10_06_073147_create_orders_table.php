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
            $table->foreignId('user_id')->constrained();
            $table->string('unique_code')->unique();
            $table->foreign('unique_code')
                ->references('unique_code')
                ->on('carts')
                ->onDelete('cascade');
            $table->foreignId('address_id')->constrained();
            $table->string('gate');
            $table->unsignedBigInteger('price_total');
            $table->string('transaction_id')->nullable();
            $table->string('status');
            $table->foreignId('progress_id')
                ->default(1)->constrained('orders_progress','id');
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
