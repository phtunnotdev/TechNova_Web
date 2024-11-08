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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_code', 20)->unique();
            $table->integer('percent');
            $table->integer('min_price')->nullable();
            $table->integer('max_price');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('quantity');
            $table->integer('used_quantity')->default(0);
            $table->text('for_user_ids')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
