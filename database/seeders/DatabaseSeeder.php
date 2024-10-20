<?php
// DATOS DE PRUBEA (SEEDERS)

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Estado;
use App\Models\Cultura;
use App\Models\CulturaEstado;
use App\Models\Zona;
use App\Models\Resenia;
use App\Models\ReseniaImagen;
use App\Models\ZonaImagen;
use App\Models\CulturaImagen;
use App\Models\UbicacionZona;
use App\Models\UbicacionEstado;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Rol::factory(2) -> create();
        Usuario::factory(20) -> create();

        Estado::factory(32) -> create();
        Cultura::factory(34) -> create();
        Zona::factory(171) -> create();
        // CulturaEstado::factory(50) -> create();
        CulturaImagen::factory(70) -> create();
        ZonaImagen::factory(350) -> create();
        UbicacionEstado::factory(32) -> create();
        UbicacionZona::factory(171) -> create();

        Resenia::factory(50) -> create();
        ReseniaImagen::factory(70) -> create();

    }
}
