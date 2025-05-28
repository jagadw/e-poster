<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('podium_presentations', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreign('code')->references('code')->on('posters')->onDelete('cascade');
            $table->string('name');
            $table->string('title');
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('room');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podium_presentations');
    }
};
