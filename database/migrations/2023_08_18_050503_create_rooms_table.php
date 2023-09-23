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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('sub_title_ar');
            $table->string('sub_title_en');
            $table->string('type');
            $table->integer('floor');
            $table->boolean('room_services');
            $table->boolean('bed');
            $table->boolean('TV');
            $table->integer('guests_number');
            $table->integer('price');
            $table->longText('content_ar');
            $table->longText('content_en');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
