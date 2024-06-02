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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('id_customer');
            $table->unsignedBigInteger('id_car');
            $table->unsignedBigInteger('id_driver')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->time('pickup_time');
            $table->integer('total');
            $table->integer('total_penalty')->default(0)->nullable();
            $table->ENUM('booking_stat',['Pending Payment','Paid', 'Ongoing', 'Done']);
            $table->timestamps();

            // foreign key
            $table->foreign('id_car')->references('id')->on('cars');
            $table->foreign('id_driver')->references('id')->on('drivers');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
