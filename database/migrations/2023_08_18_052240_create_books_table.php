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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('full_name_en');
            $table->string('full_name_ar');
            $table->string('phone');
            $table->string('email');
            $table->string('check_in_date');
            $table->string('check_out_date');
            $table->string('room_type_en');
            $table->string('room_type_ar');
            $table->integer('guests_number');
            $table->longText('content_en');
            $table->longText('content_ar');
=======
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->string('room_type');
            $table->integer('guests_number');
            $table->longText('content');
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
