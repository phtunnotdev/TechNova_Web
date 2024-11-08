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
            $table->string('order_code', 20)->unique();
            $table->enum('status', ['cxn', 'dxn', 'dgh', 'ghtc', 'ghtb', 'dh', 'dndh']);
            $table->enum('payment_method', ['cod', 'online']);
            $table->enum('payment_status', ['ctt', 'dtt']);
            $table->integer('total_price');
            $table->string('user_name', 100);
            $table->string('user_phone', 15);
            $table->string('user_address', 255);
            $table->string('note')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
