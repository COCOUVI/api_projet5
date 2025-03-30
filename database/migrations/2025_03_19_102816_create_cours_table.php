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
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->unsignedBigInteger('id_classe');
            $table->unsignedBigInteger('id_professeur');
            $table->foreign('id_classe')->references('id')->on('classes');
            $table->foreign('id_professeur')->references('id')->on('professeurs');
            $table->string('salle');
            $table->string('dir_schedules');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
