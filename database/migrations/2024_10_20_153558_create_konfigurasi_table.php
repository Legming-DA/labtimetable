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
        Schema::create('konfigurasi', function (Blueprint $table) {
            $table->integer('kd')->default(1); // Kolom 'kd', mungkin sebagai key tetap
            $table->integer('popsize'); // Kolom 'individu'
            $table->integer('generasi'); // Kolom 'iterasi'
            $table->decimal('crossrate', 5, 2); // Kolom 'pc' dengan tipe decimal (untuk nilai probabilitas crossover)
            $table->decimal('mutrate', 5, 2); // Kolom 'pm' dengan tipe decimal (untuk nilai probabilitas mutasi)
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi');
    }
};
