<?php

namespace Database\Factories;

use App\Models\Instalacion;
use App\Models\Producto;
use App\Models\Segregacion;
use App\Models\Ubicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsolidadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $instalacion_id = Instalacion::pluck('id');
        $ubicacion_id = Ubicacion::pluck('id');
        $producto_id = Producto::pluck('id');
        $segregacion_id = Segregacion::pluck('id');

        return [
            'fecha' => $this->faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
            'instalacion_id' => $this->faker->randomElement($instalacion_id),
            'ubicacion_id' => $this->faker->randomElement($ubicacion_id),
            'cliente' => substr($this->faker->name(), 0, 45),
            'producto_id' => $this->faker->randomElement($producto_id),
            'segregacion_id' => $this->faker->randomElement($segregacion_id),
            'destino' => substr($this->faker->city(), 0, 45),
            'volumen' => $this->faker->numberBetween(300, 1500),
            'certificado' => 'certificados/IfOVFFI9pJ5RCQvpUpdTZgt7oOxg2C7LRhe2N1np.pdf',
            'borrado' => '0',
        ];
    }
}
