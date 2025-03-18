<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    // Método para crear un hotel
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:hoteles',
            'direccion' => 'required|string',
            'ciudad' => 'required|string',
            'nit' => 'required|string|unique:hoteles',
            'numero_habitaciones' => 'required|integer|min:1',
        ]);

        $hotel = Hotel::create($validated);

        return response()->json([
            'message' => 'Hotel creado exitosamente.',
            'data' => $hotel,
        ], 201);
    }

    // Método para listar los hoteles
    public function index()
    {
        $hoteles = Hotel::all();
1
        return response()->json($hoteles);
    }
}
