<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $hoteles = [
            [
                'nombre' => 'Decameron Cartagena',
                'direccion' => 'Calle 23 58-25',
                'ciudad' => 'Cartagena',
                'nit' => '12345678-9',
                'num_habitaciones' => 42,
            ],
            [
                'nombre' => 'Decameron Santa Marta',
                'direccion' => 'Av. Tamacá 15-55',
                'ciudad' => 'Santa Marta',
                'nit' => '98765432-1',
                'num_habitaciones' => 55,
            ],
        ];

        foreach ($hoteles as $hotel) {
            Hotel::create($hotel);
        }
    }
}
