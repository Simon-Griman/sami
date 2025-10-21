<?php

namespace Database\Seeders;

use App\Models\Instalacion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(InstalacionSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(UbicacionSeeder::class);
    }
}
