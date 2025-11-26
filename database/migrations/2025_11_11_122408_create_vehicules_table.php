<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('immatriculation')->unique(); // Numéro de plaque
            $table->string('marque');
            $table->string('modele');
            $table->integer('annee')->nullable();
            $table->string('couleur')->nullable();

            // 🔗 Relation avec les chauffeurs
            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('drivers')
                ->onDelete('set null'); // si le chauffeur est supprimé, le champ devient null

            // 🚗 Suivi d’état du véhicule
            $table->enum('statut', ['actif', 'en_panne', 'en_entretien'])->default('actif');
            $table->text('remarques')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
