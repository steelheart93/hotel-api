<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use app\Models\Acomodacion;
use App\Models\Habitacion;
use App\Models\Hotel;
use App\Models\TipoHabitacion;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $hotelId = $request->query('hotel_id');

        $habitaciones = Habitacion::where('hotel_id', $hotelId)
            ->with('tipoHabitacion', 'acomodacion')
            ->get();

        return response()->json($habitaciones, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hoteles,id',
            'tipo_habitacion_id' => 'required|exists:tipo_habitacions,id',
            'acomodacion_id' => 'required|exists:acomodaciones,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $hotel = Hotel::findOrFail($request->hotel_id);

        // Validar que la suma total no exceda el número máximo de habitaciones
        $totalHabitaciones = $hotel->habitaciones->sum('cantidad') + $request->cantidad;
        if ($totalHabitaciones > $hotel->num_habitaciones) {
            return response()->json(['error' => 'La cantidad total de habitaciones excede el límite permitido.'], 400);
        }

        // Validar combinaciones únicas de tipo y acomodación para el hotel
        $existe = Habitacion::where('hotel_id', $request->hotel_id)
            ->where('tipo_habitacion_id', $request->tipo_habitacion_id)
            ->where('acomodacion_id', $request->acomodacion_id)
            ->exists();

        if ($existe) {
            return response()->json(['error' => 'Ya existe esta combinación de tipo y acomodación para este hotel.'], 400);
        }

        // Validar reglas específicas para tipos de habitación y acomodaciones
        $validas = [
            'Estándar' => ['Sencilla', 'Doble'],
            'Junior' => ['Triple', 'Cuádruple'],
            'Suite' => ['Sencilla', 'Doble', 'Triple'],
        ];

        $tipo = TipoHabitacion::findOrFail($request->tipo_habitacion_id)->tipo;
        $acomodacion = Acomodacion::findOrFail($request->acomodacion_id)->tipo;

        if (!in_array($acomodacion, $validas[$tipo])) {
            return response()->json(['error' => 'La acomodación no es válida para este tipo de habitación.'], 400);
        }

        $habitacion = Habitacion::create($request->all());
        return response()->json($habitacion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $habitacion = Habitacion::with('hotel', 'tipoHabitacion', 'acomodacion')->find($id);

        if (!$habitacion) {
            return response()->json(['error' => 'Habitación no encontrada'], 404);
        }

        return response()->json($habitacion, 200);
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
        $habitacion = Habitacion::find($id);

        if (!$habitacion) {
            return response()->json(['error' => 'Habitación no encontrada'], 404);
        }

        $request->validate([
            'cantidad' => 'sometimes|integer|min:1',
        ]);

        $habitacion->update($request->all());
        return response()->json($habitacion, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::find($id);

        if (!$habitacion) {
            return response()->json(['error' => 'Habitación no encontrada'], 404);
        }

        $habitacion->delete();
        return response()->json(['message' => 'Habitación eliminada correctamente'], 200);
    }
}
