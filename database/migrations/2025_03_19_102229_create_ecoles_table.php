<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ecoles', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('address');
            
            // Déclaration unique avec clé étrangère
            $table->foreignId('id_user')
                  ->constrained('users') // 'users' est le nom de la table parente
                  ->onDelete('cascade');  // Optionnel : suppression en cascade
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecoles');
    }
};