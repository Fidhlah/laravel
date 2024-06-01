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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(false);
            $table->text('thumbnail')->nullable(false);
            $table->integer('harga')->nullable(false);
            $table->string('seat')->nullable(false);
            $table->enum('transmisi', ['Manual', 'Matic'])->nullable(false);
            $table->enum('status', ['Tersedia', 'Digunakan'])->nullable(false)->default('Tersedia');
            $table->integer('terpakai')->nullable(false)->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
