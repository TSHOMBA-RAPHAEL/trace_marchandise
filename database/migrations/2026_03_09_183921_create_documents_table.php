<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            // Clé étrangère liée à la marchandise (Si on supprime la marchandise, ça supprime le document)
            $table->foreignId('marchandise_id')->constrained('marchandises')->onDelete('cascade');
            $table->string('nom_fichier'); // Le vrai nom du fichier (ex: facture.pdf)
            $table->string('chemin_fichier'); // L'endroit où il est rangé sur le serveur
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};