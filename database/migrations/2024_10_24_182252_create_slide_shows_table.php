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
        Schema::create('slide_shows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image_one');
            $table->string('link_one');
            $table->text('image_two');
            $table->string('link_two');
            $table->text('image_three');
            $table->string('link_three');
            $table->enum('arrows', ['on', 'off'])->default('on');
            $table->enum('dots', ['on', 'off'])->default('on');
            $table->enum('active', ['on', 'off'])->default('on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide_shows');
    }
};