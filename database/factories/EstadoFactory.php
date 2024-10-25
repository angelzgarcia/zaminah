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
        // $dir =  storage_path('app/public/imgs_fake');

        // if (!is_dir($dir)) {
        //     mkdir($dir, 0755, true);
        // }

        return [
            'nombre'=> fake() -> unique() -> randomElement([
                'Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Chiapas',
                'Chihuahua', 'Ciudad de México', 'Coahuila', 'Colima', 'Durango', 'Guanajuato',
                'Guerrero', 'Hidalgo', 'Jalisco', 'Estado de México', 'Michoacán', 'Morelos',
                'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo',
                'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala',
                'Veracruz', 'Yucatán', 'Zacatecas'
            ]),
            // 'slug' => fake() -> slug(),
            'capital'=> fake() -> unique() -> city(),
            'foto' => fake() ->  imageUrl(),
            'video'=> fake() -> url(),
            'triptico'=> 'triptico.pdf',
            'guia'=> 'guia.pdf',
        ];
    }
}
