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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('category')->nullable();
            $table->string('link');
            $table->unsignedBigInteger('article_id')->index('article_id')->nullable();
            $table->foreign('article_id')->references('id')->on('articles')->onUpdate('CASCADE')->onDelete('CASCADE');
=======
            $table->enum('type', ['Restaurant', 'Chalet', 'Activity', 'Nature', 'Events']);
            $table->string('name');
            $table->string('link');
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
