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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_eleve');
            $table->unsignedBigInteger('id_tuteur');
            $table->foreign('id_eleve')->references('id')->on('eleves');
            $table->foreign('id_tuteur')->references('id')->on('tuteurs');
            $table->string('type');
            $table->string('message');
            $table->string('statu');
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
