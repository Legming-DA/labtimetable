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
        Schema::create('ketersediaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_asisten');
            $table->foreign('id_asisten')->references('id_asisten')->on('asistens');
            $table->unsignedBigInteger('id_kelasprak');
            $table->foreign('id_kelasprak')->references('id_kelasprak')->on('kelasprak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketersediaan');
    }
};
