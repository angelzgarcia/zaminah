<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estado>
 */
class EstadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=> $this->faker->city(),
            'capital'=> $this->faker->city(),
            'foto' => $this->faker->image(storage_path('app/public/img/factories'), 640, 480, 'nature', false),
            'video'=> $this->faker->url(),
            'triptico'=> 'triptico.pdf',
            'guia'=> 'guia.pdf',
        ];
    }
}
