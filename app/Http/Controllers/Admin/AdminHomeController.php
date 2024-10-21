<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class AdminHomeController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    public function show_database() {
        $tables = DB::select('SHOW TABLES');
        $table_name = env('DB_DATABASE');
        $column_name = "Tables_in_{$table_name}";

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

}
