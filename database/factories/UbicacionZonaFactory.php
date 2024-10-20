<?php

namespace Database\Factories;

use App\Models\Zona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UbicacionZona>
 */
class UbicacionZonaFactory extends Factory
{
    private static $usedIds = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $zonas = Zona::all();

        // Verificar si hay zonas disponibles
        if ($zonas->isEmpty()) {
            throw new \Exception("No hay zonas disponibles para asignar a las ubicaciones.");
        }

        // Filtrar los IDs de zonas que no se han usado
        $availableIds = $zonas->pluck('idZonaArqueologica')->diff(self::$usedIds);

        // Si no quedan IDs disponibles, lanzar excepción
        if ($availableIds->isEmpty()) {
            throw new \Exception("No quedan IDs de zona arqueológica disponibles.");
        }

        // Seleccionar un ID disponible
        $idZonaArqueologica = $availableIds->random();

        // Registrar el ID utilizado
        self::$usedIds[] = $idZonaArqueologica;

        return [
            'latitud' => fake() -> unique() -> latitude(),
            'longitud' => fake() -> unique() -> longitude(),
            
            'idZonaArqueologica' => $idZonaArqueologica,
        ];
    }
}
