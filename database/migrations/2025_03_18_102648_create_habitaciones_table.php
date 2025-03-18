<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();

            // Relación con hoteles
            $table->foreignId('hotel_id')
                  ->constrained('hoteles') // Relación con la tabla 'hoteles'
                  ->onDelete('cascade') // Elimina habitaciones al eliminar el hotel
                  ->onUpdate('cascade');

    

            $table->string('acomodacion'); // Ejemplo: "Sencilla", "Doble"
            $table->integer('cantidad'); // Número de habitaciones de este tipo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};
