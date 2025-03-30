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
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->unsignedBigInteger('id_classe');
            // $table->unsignedBigInteger('id_tuteur');
            $table->foreign('id_classe')->references('id')->on('classes');
            $table->string('contact');
            $table->string('email');
            // $table->foreign('id_tuteur')->references('id')->on('tuteurs');
            $table->string('nom_tuteur');
            $table->string('prenom_tuteur');
            $table->string('email_tuteur');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};
