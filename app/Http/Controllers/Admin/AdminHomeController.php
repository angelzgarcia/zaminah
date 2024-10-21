<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;
use App\Models\Cultura;
use App\Models\CulturaEstado;
use App\Models\CulturaImagen;
use App\Models\Estado;
use App\Models\ReseniaImagen;
use App\Models\Rol;
use App\Models\UbicacionEstado;
use App\Models\UbicacionZona;
use App\Models\ZonaImagen;

use function Laravel\Prompts\table;

class AdminHomeController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    public function show_database() {
        $tables = DB::select('SHOW TABLES');
        $databse_name = env('DB_DATABASE');
        $column_name = "Tables_in_{$databse_name}";

        $tables_with_counts = [];

        foreach($tables as $table):
            $table_name = $table -> $column_name;
            $table_count = DB::table($table_name) -> count();

            $tables_with_counts[] = [
                'name' => $table_name,
                'count' => $table_count,
            ];
        endforeach;

        return view('admin.database', [
            'tables_and_counts' => $tables_with_counts,
            'tables_count' => count($tables_with_counts)
        ]);
    }

    public function show_migrations() {
        return view('admin.database');
    }

    public function show_roles() {
        $roles = Rol::paginate();

        return view('admin.roles.index', compact('roles'));
    }

    public function show_cultures_states() {
        $cultures_states = CulturaEstado::paginate();

        return view('admin.culturas_estados.index', compact('cultures_states'));
    }

    public function show_zones_images() {
        $zones_images = ZonaImagen::paginate();

        return view('admin.zonas_fotos.index', compact('zones_images'));
    }

    public function show_reviews_images() {
        $reviews_images = ReseniaImagen::paginate();

        return view('admin.resenias_fotos.index', compact('reviews_images'));
    }

    public function show_cultures_images() {
        $cultures_images = CulturaImagen::paginate();

        return view('admin.culturas_fotos.index', compact('cultures_images'));
    }

    public function show_zones_locations() {
        $zones_locations = UbicacionZona::paginate();

        return view('admin.ubicaciones_zonas.index', compact('zones_locations'));
    }

    public function show_states_locations() {
        $states_locations = UbicacionEstado::paginate();

        return view('admin.ubicaciones_estados.index', compact('states_locations'));
    }

}
