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
        Schema::create('marchandises', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique(); // Numéro de référence unique
            $table->text('description'); // Description de la marchandise
            $table->string('importateur'); // Informations sur l'importateur
            $table->enum('statut', ['en attente', 'en contrôle', 'validée', 'bloquée'])->default('en attente'); // Le statut par défaut
            $table->timestamps(); // Crée automatiquement created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marchandises');
    }
};
