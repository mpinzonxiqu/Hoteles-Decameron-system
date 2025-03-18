<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoHabitacion;

class TipoHabitacionController extends Controller
{
    public function index()
    {
        // Retornar todos los tipos de habitación
        return TipoHabitacion::all();
    }

    public function store(Request $request)
    {
        // Validar y crear un nuevo tipo de habitación
        $validated = $request->validate([
            'nombre' => 'required|in:Estándar,Junior,Suite|unique:tipo_habitacions,nombre',
        ]);

        $tipoHabitacion = TipoHabitacion::create($validated);

        return response()->json($tipoHabitacion, 201);
    }

    public function show($id)
    {
        // Mostrar un tipo de habitación específico
        return TipoHabitacion::findOrFail($id);
    }
}
