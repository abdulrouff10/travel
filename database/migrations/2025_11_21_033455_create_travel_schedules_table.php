<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        // database/migrations/xxxx_xx_xx_xxxxxx_create_travel_schedules_table.php
    public function up()
    {
        Schema::create('travel_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('tujuan');
            $table->date('tanggal_keberangkatan');
            $table->time('waktu_keberangkatan');
            $table->integer('kouta');
            $table->decimal('harga', 10, 2);
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_schedules');
    }
};
