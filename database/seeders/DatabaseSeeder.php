<?php
// DATOS DE PRUBEA (SEEDERS)

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado;
use App\Models\Cultura;
use App\Models\Ubicacion;
use App\Models\Zona;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        Estado::factory(32) -> create();
        Cultura::factory(34) -> create();
        Zona::factory(171) -> create();

        Ubicacion::factory(171) -> create();

    }
}
