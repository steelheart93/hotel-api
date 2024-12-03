<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Habitacion;
use App\Models\Hotel;
use App\Models\TipoHabitacion;
use App\Models\Acomodacion;

class HabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $hotel = Hotel::where('nombre', 'Decameron Cartagena')->first();

        $tipoEstándar = TipoHabitacion::where('nombre', 'Estándar')->first();
        $tipoJunior = TipoHabitacion::where('nombre', 'Junior')->first();

        $acomodacionSencilla = Acomodacion::where('nombre', 'Sencilla')->first();
        $acomodacionDoble = Acomodacion::where('nombre', 'Doble')->first();
        $acomodacionTriple = Acomodacion::where('nombre', 'Triple')->first();

        $habitaciones = [
            [
                'hotel_id' => $hotel->id,
                'tipo_habitacion_id' => $tipoEstándar->id,
                'acomodacion_id' => $acomodacionSencilla->id,
                'cantidad' => 25,
            ],
            [
                'hotel_id' => $hotel->id,
                'tipo_habitacion_id' => $tipoJunior->id,
                'acomodacion_id' => $acomodacionTriple->id,
                'cantidad' => 12,
            ],
            [
                'hotel_id' => $hotel->id,
                'tipo_habitacion_id' => $tipoEstándar->id,
                'acomodacion_id' => $acomodacionDoble->id,
                'cantidad' => 5,
            ],
        ];

        foreach ($habitaciones as $habitacion) {
            Habitacion::create($habitacion);
        }
    }
}
