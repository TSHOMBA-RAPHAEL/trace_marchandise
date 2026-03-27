<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marchandise_id')->constrained('marchandises')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Celui qui a fait l'action
            $table->string('action'); // Ex: "Enregistrement initial", "Statut changé en Validé"
            $table->timestamps(); // Gère automatiquement la date et l'heure
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historiques');
    }
};