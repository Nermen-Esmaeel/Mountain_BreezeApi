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
<<<<<<< HEAD
            $table->string('name');
            $table->string('type');
            $table->integer('guests_number');
            $table->integer('price');
            $table->longText('content');
=======
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('type');
            $table->integer('guests_number');
            $table->integer('price');
            $table->longText('content_ar');
            $table->longText('content_en');
            $table->enum('status', ['available', 'unavailable'])->default('available');
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
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
