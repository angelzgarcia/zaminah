<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ubicacion;
use App\Models\Cultura;
use App\Models\Estado;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zona>
 */
class ZonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // $idEstado = \App\Models\Estado::all()->random()->id ?? \App\Models\Estado::factory()->create()->id;
        // $idCultura = \App\Models\Cultura::all()->random()->id ?? \App\Models\Cultura::factory()->create()->id;
        // $idUbicacion = \App\Models\Ubicacion::all()->random()->id ?? \App\Models\Ubicacion::factory()->create()->id;
        // 'contacto' => $this -> faker -> sentences(4, true),

        return [
            'nombre' => fake() -> unique() -> randomElement([
                "Ake", "Altavista", "Amapa", "Amatitlán", "Amazcala", "Arroyo Seco", "Balankanché", "Balamkú", "Bonampak", "Becán",
                "Calakmul", "Cañada de la Virgen", "Cantona", "Cempoala", "Chacmultún", "Chacchoben", "Chichen Itzá", "Chinkultic", "Chocolá",
                "Coba", "Comalcalco", "Dzibilchaltún", "Dzibanché", "Edzná", "Ek Balam", "El Cerrito", "El Meco", "El Rey", "El Tajín",
                "El Tepozteco", "El Tigre", "Guachimontones", "Hochob", "Ichkabal", "Ihuatzio", "Izapa", "Ixcateopan", "Jaina", "Kabah",
                "Kohunlich", "La Campana", "La Quemada", "Las Labradas", "Los Horcones", "Malinalco", "Mitla", "Mixco Viejo", "Monte Albán", "Muyil",
                "Oxkintok", "Paquimé", "Palenque", "Plazuelas", "Pomona", "Puxcatán", "Quiahuiztlán", "San Gervasio", "Sayil", "Silvituc",
                "Tamtoc", "Tancama", "Tamuín", "Tancol", "Tancoc", "Tecoaque", "Tecpan", "Tehuacalco",
                "Teopanzolco", "Teteles de Santo Domingo", "Tetitla", "Tetzcotzinco", "Tikal", "Tilantongo", "Tingambato", "Toniná", "Tula",
                "Tulum", "Tzintzuntzan", "Uxmal", "Vista Alegre", "Xcambó", "Xel-Há", "Xochicalco", "Xochipala", "Xpuhil", "Yaaxhom",
                "Yaxchilán", "Yaxunah", "Yohualichan", "Yugue", "Zacatecas", "Zaachila", "Zinacantán", "Zultépec", "Zohapilco",
                "Abasolo", "Aguada Fénix", "Amatlán", "Atzompa", "Azacualpa", "Baja California", "Baluarte", "Benito Juárez", "Boquillas del Carmen", "Calderitas",
                "Calvillo", "Casa Blanca", "Caucel", "Chacpet", "Chakanbakán", "Chalcatzingo", "Chetumal", "Chiautla", "Coatetelco", "Coixtlahuaca",
                "Colatlán", "Coxcatlán", "Cuajilote", "Cuilapan", "Dainzú", "Dos Pilas", "Dzibilnocac", "Escalona", "Floral",
                "Hormiguero", "Huamelulpan", "Huapalcalco", "Huetamo", "Huitzilac", "Izamal", "Ixil", "Jaltipán", "Joya de Cerén",
                "La Cobacha", "Loltún", "Mayapán", "Mélida", "Mina Vieja", "Misquihualco", "Nueve Palos", "Pahñú", "Pahuatlán", "Pak Tzab",
                "Panhuatlán", "Piedras Negras", "Pinzán", "Poxbíl", "Puerto Escondido", "Pueblo Viejo", "Quiriguá",
                "San Felipe", "San Francisco de los Chuliches", "San Isidro", "Teotihuacan", "San Miguel Ixtapan", "San Salvador el Verde", "Santa Rosa", "Sihualtepec", "Tabasqueña",
                "Tanjay", "Tapaxco", "Tecamachalco", "Tepeapulco", "Tepecuacuilco", "Tepoztlán", "Texcatzingo", "Tlacopan", "Tlatilco",
                "Tlayúa", "Tocuila", "Tonatico", "Uxul", "Villa Alta", "Yagul"
            ]),
            // 'foto' => fake() -> imageUrl(),
            'significado' => fake() -> sentences(2, true),
            'descripcion' => fake() -> paragraphs(3, true),
            'acceso' => fake() -> paragraphs(2, true),
            'horario' => fake() -> sentences(3, true),
            'costoEntrada' => fake() -> randomFloat(2, 0, 99.99),
            'contacto' => fake() -> sentences(4, true),

            'idEstadoRepublica' => Estado::inRandomOrder()
                                -> first()
                                -> idEstadoRepublica,
            'idCultura' => Cultura::inRandomOrder()
                        -> first()
                        -> idCultura
        ];
    }
}
