<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
use App\Models\Zona;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resenia>
 */
class ReseniaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mensaje' => fake() -> paragraphs(3, true),
            'puntuacion' => fake() -> randomNumber(1, true),

            'idUsuario' => Usuario::inRandomOrder()
                        -> first()
                        -> idUsuario,
            'idZonaArqueologica' => Zona::inRandomOrder()
                                -> first()
                                -> idZonaArqueologica,

        ];
    }
}
