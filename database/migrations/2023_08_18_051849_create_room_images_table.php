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
        Schema::create('room_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->unsignedBigInteger('room_id')->index('room_id');
            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_images');
    }
};
