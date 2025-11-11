<?php

namespace Database\Seeders;

use App\Models\Consolidado;
use Illuminate\Database\Seeder;

class ConsolidadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Consolidado::factory()->count(150)->create();
    }
}
