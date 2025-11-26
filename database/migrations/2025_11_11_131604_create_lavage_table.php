<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lavages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicule_id')->constrained('vehicules')->onDelete('cascade');
            $table->date('date_lavage');
            $table->string('type')->default('standard'); // standard, complet, intérieur seulement, etc.
            $table->string('effectué_par')->nullable(); // nom du laveur
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lavages');
    }
};
