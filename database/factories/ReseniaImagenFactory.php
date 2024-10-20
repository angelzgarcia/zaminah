<?php

namespace Database\Factories;

use App\Models\Resenia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReseniaImagen>
 */
class ReseniaImagenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dir = storage_path('app/public/imgs_fake');

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        return [
            'foto' => fake() -> image($dir, 640, 480, null, true),

            'idResenia' => Resenia::inRandomOrder()
                        -> first()
                        -> idResenia,
        ];
    }
}
