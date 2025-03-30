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
        Schema::create('rapport_presences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_classe');
            $table->unsignedBigInteger('id_cour');
            $table->foreign('id_classe')->references('id')->on('classes');
            $table->foreign('id_cour')->references('id')->on('cours');
            $table->dateTime('date');
            $table->string('dir_rapport');
            $table->longText('comments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport_presences');
    }
};
