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
        Schema::create('slide_show_galleries', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->string('link')->nullable();
            $table->foreignId('slide_show_id')->constrained('slide_shows')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide_show_galleries');
    }
};