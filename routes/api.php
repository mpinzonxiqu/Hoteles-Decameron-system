<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HabitacionController;



Route::prefix('hoteles')->group(function () {
    Route::post('/', [HotelController::class, 'store']); // Crear hotel
    Route::get('/', [HotelController::class, 'index']); // Listar hoteles
    Route::post('/{hotel_id}/habitaciones', [HabitacionController::class, 'asignarHabitaciones']); // Asignar tipos de habitaciones
    Route::post('/{hotel_id}/validar-restricciones', [HabitacionController::class, 'validarRestricciones']); // Validar restricciones
});
