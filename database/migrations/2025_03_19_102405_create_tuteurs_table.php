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
        Schema::create('tuteurs', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            // Déclaration unique avec clé étrangère
            $table->foreignId('id_user')
                  ->constrained('users') // 'users' est le nom de la table parente
                  ->onDelete('cascade');  // Optionnel : suppression en cascade
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuteurs');
    }
};
