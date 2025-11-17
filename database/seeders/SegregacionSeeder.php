<?php

namespace Database\Seeders;

use App\Models\Segregacion;
use Illuminate\Database\Seeder;

class SegregacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Segregacion::create(['nombre' => 'Gasolina 91', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Gasoil', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Diesel Marino', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Ifo 380', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Fuel Oil', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Jet A1', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Solventes', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Asfalto', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Negro de Humo', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Crudo', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Lubricantes', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Condensado', 'hidrocarburo' => 'Producto']);
        Segregacion::create(['nombre' => 'Alquitran', 'hidrocarburo' => 'Producto']);

        Segregacion::create(['nombre' => 'Crudo con propósitos generales (CPG)', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Boscan', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Laguna', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Bachaquero', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Lagotreco', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Menemota', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Lagomar', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Lagomedio', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Urdaneta Pesado', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Tia Juana Liviano', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Tia Juana Mediano', 'hidrocarburo' => 'Crudo']);
        Segregacion::create(['nombre' => 'Crudo Guafita', 'hidrocarburo' => 'Crudo']);
    }
}
