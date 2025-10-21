<?php

namespace Database\Seeders;

use App\Models\Instalacion;
use Illuminate\Database\Seeder;

class InstalacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instalacion::create(['nombre' => 'Planta de Distribución']);
        Instalacion::create(['nombre' => 'Planta de Suministro']);
        Instalacion::create(['nombre' => 'Muelle']);
        Instalacion::create(['nombre' => 'Patio de Tanques']);
    }
}
