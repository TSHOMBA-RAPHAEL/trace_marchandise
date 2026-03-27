<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('marchandises', function (Blueprint $table) {
            // On ajoute une colonne 'motif' qui peut être vide (nullable)
            $table->text('motif')->nullable()->after('statut');
        });
    }

    public function down(): void
    {
        Schema::table('marchandises', function (Blueprint $table) {
            $table->dropColumn('motif');
        });
    }
};