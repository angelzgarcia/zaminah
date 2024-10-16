<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cultura>
 */
class CulturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake() -> unique() -> randomElement([
                "Chichimeca",
                "Otomí",
                "Kumiai",
                "Paipai",
                "Cocopah",
                "Pericú",
                "Guaycura",
                "Maya",
                "Lacandona",
                "Tarahumara",
                "Paquimé",
                "Coahuilteco",
                "Nahua",
                "Tepehuano",
                "Chupícuaro",
                "Purépecha",
                "Mezcala",
                "Tepehua",
                "Teuchitlán",
                "Mexica",
                "Tolteca",
                "Matlatzinca",
                "Zapoteca",
                "Mixteca",
                "Popoloca",
                "Cora",
                "Huichol",
                "Huasteca",
                "Seri",
                "Olmeca",
                "Tlaxcalteca",
                "Totonaca",
                "Caxcan",
                "Tehuelche"
            ]),
            'periodo' => fake() -> sentence(3, true),
            'significado' => fake() -> sentences(2, true),
            'descripcion' => fake() -> paragraphs(3, true),
            // 'foto' => fake() -> imageUrl(),
            'aportaciones' => fake() -> paragraph()
        ];
    }
}
