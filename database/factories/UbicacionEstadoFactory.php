<?php

namespace Database\Factories;

use App\Models\Estado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UbicacionEstado>
 */
class UbicacionEstadoFactory extends Factory
{
    private static $usedIds = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $estados = Estado::all();

        // Verificar si hay zonas disponibles
        if ($estados->isEmpty()) {
            throw new \Exception("No hay estados disponibles para asignar a las ubicaciones.");
        }

        // Filtrar los IDs de zonas que no se han usado
        $availableIds = $estados->pluck('idEstadoRepublica')->diff(self::$usedIds);

        // Si no quedan IDs disponibles, lanzar excepción
        if ($availableIds->isEmpty()) {
            throw new \Exception("No quedan IDs de estados de la republica disponibles.");
        }

        // Seleccionar un ID disponible
        $idEstado = $availableIds->random();

        // Registrar el ID utilizado
        self::$usedIds[] = $idEstado;

        return [
            'latitud' => fake() -> unique() -> latitude(),
            'longitud' => fake() -> unique() -> longitude(),
            
            'idEstadoRepublica' => $idEstado,
        ];
    }
}
