<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los hoteles
        $hoteles = Hotel::all();
        return view('hoteles.index', compact('hoteles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hoteles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:hotels|max:255',
            'direccion' => 'required',
            'ciudad' => 'required',
            'nit' => 'required|unique:hotels',
            'num_habitaciones' => 'required|integer|min:1',
        ]);

        $hotel = Hotel::create($request->all());
        return response()->json($hotel, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hotel = Hotel::with('habitaciones.tipoHabitacion', 'habitaciones.acomodacion')->find($id);

        if (!$hotel) {
            return response()->json(['error' => 'Hotel no encontrado'], 404);
        }

        return response()->json($hotel, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['error' => 'Hotel no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|unique:hotels,nombre,' . $id,
            'direccion' => 'sometimes',
            'ciudad' => 'sometimes',
            'nit' => 'sometimes|unique:hotels,nit,' . $id,
            'num_habitaciones' => 'sometimes|integer|min:1',
        ]);

        $hotel->update($request->all());
        return response()->json($hotel, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['error' => 'Hotel no encontrado'], 404);
        }

        $hotel->delete();
        return response()->json(['message' => 'Hotel eliminado correctamente'], 200);
    }
}
