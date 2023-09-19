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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('article_cover')->nullable();
            $table->enum('category', ['Restaurant', 'Chalet', 'Activity', 'Nature', 'Pool', 'Resort Events' , 'Sport Events']);
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('sub_title_en');
            $table->string('sub_title_ar');
            $table->longText('content_en');
            $table->longText('content_ar');
            $table->date('date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
