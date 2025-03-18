<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\Hotel;
use App\Models\TipoHabitacion;

class HabitacionController extends Controller
{
    // Asignar tipos de habitación a un hotel
    public function asignarHabitaciones(Request $request, $hotel_id)
    {
        $hotel = Hotel::findOrFail($hotel_id);

        $validated = $request->validate([
            'habitaciones' => 'required|array',
            'habitaciones.*.tipo_habitacion_id' => 'required|exists:tipos_habitacion,id',
            'habitaciones.*.acomodacion' => 'required|string',
            'habitaciones.*.cantidad' => 'required|integer|min:1',
        ]);

        $totalHabitaciones = 0;

        foreach ($validated['habitaciones'] as $habitacion) {
            $totalHabitaciones += $habitacion['cantidad'];

            Habitacion::create([
                'hotel_id' => $hotel_id,
                'tipo_habitacion_id' => $habitacion['tipo_habitacion_id'],
                'acomodacion' => $habitacion['acomodacion'],
                'cantidad' => $habitacion['cantidad'],
            ]);
        }

        // Validar que el total de habitaciones no exceda el límite del hotel
        if ($totalHabitaciones > $hotel->numero_habitaciones) {
            return response()->json([
                'status' => 'error',
                'message' => 'El número total de habitaciones supera el máximo permitido.',
            ], 400);
        }

        return response()->json([
            'message' => 'Tipos de habitación asignados exitosamente.',
        ]);
    }

    // Validar restricciones de habitaciones
    public function validarRestricciones($hotel_id)
    {
        $hotel = Hotel::findOrFail($hotel_id);
        $habitaciones = $hotel->habitaciones;

        $totalHabitaciones = $habitaciones->sum('cantidad');

        if ($totalHabitaciones > $hotel->numero_habitaciones) {
            return response()->json([
                'status' => 'error',
                'message' => 'El número total de habitaciones supera el máximo permitido.',
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Restricciones validadas con éxito.',
        ]);
    }
}
