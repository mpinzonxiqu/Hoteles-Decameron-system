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
        Schema::create('tipos_habitacion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('tipo')->unique(); // Ejemplo: "Estándar", "Junior", "Suite"
            $table->json('acomodaciones_permitidas'); // Ejemplo: ["Sencilla", "Doble"]
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_habitacion');
    }
};
