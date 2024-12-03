<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Acomodacion;

class AcomodacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $acomodaciones = [
            ['nombre' => 'Sencilla'],
            ['nombre' => 'Doble'],
            ['nombre' => 'Triple'],
            ['nombre' => 'Cuádruple'],
        ];

        foreach ($acomodaciones as $acomodacion) {
            Acomodacion::create($acomodacion);
        }
    }
}
