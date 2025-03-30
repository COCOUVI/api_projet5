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
        Schema::create('profcours_salles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ecole');
            $table->foreign('id_ecole')->references('id')->on('ecoles');
            $table->string('Salle');
            $table->string("nom_prof");
            $table->string("pre_prof");
            $table->string("email_prof");
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profcours_salles');
    }
};
