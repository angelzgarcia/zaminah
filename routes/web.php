<?php

use App\Http\Controllers\Admin\AdminCultureController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminStateController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminZoneController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\User\UserHomeController;


/*______________________ RUTAS   PARA    USUARIOS ____________________*/

// RUTA RAIZ
Route::get('/',  [UserHomeController::class, 'index']) -> name('home');





/* _____________________ RUTAS   PARA    ADMINISTRADORES __________________*/

// RUTAS PARA DASHBOARD ADMIN
Route::controller(AdminHomeController::class) -> prefix('admin')->group(function () {
    Route::get('dashboard', 'index') -> name('admin.dashboard.index');
    Route::get('database',  'show_database') -> name('admin.database.index');
    Route::get('migrations',  'show_database') -> name('admin.migrations.index');
    Route::get('roles',  'show_roles') -> name('admin.roles.index');
    Route::get('culturas_estados',  'show_cultures_states') -> name('admin.culturas_estados.index');
    Route::get('zonas_fotos', 'show_zones_images') -> name('admin.zonas_fotos.index');
    Route::get('resenias_fotos', 'show_reviews_images') -> name('admin.resenias_fotos.index');
    Route::get('culturas_fotos', 'show_cultures_images') -> name('admin.culturas_fotos.index');
    Route::get('ubicaciones_zonas', 'show_zones_locations') -> name('admin.ubicaciones_zonas.index');
    Route::get('ubicaciones_estados', 'show_states_locations') -> name('admin.ubicaciones_estados.index');
});


// RUTAS PARA REGISTROS DE CULTURAS
Route::controller(AdminCultureController::class) -> prefix('admin/cultures') -> group(function() {
    Route::get('', 'index') -> name('admin.culturas.index');
    Route::get('create', 'create') -> name('admin.culturas.create');
    Route::post('', 'store') -> name('admin.culturas.store');
    Route::get('{culture}', 'show') -> name('admin.culturas.show');
    Route::get('{culture}/edit', 'edit') -> name('admin.culturas.edit');
    Route::put('{culture}', 'update') -> name('admin.culturas.update');
    Route::delete('{culture}', 'destroy') -> name('admin.culturas.destroy');
});

// RUTAS PARA REGISTROS DE ESTADOS
Route::controller(AdminStateController::class) -> prefix('admin/states') -> group(function() {
    Route::get('', 'index') -> name('admin.estados.index');
    Route::get('create', 'create') -> name('admin.estados.create');
    Route::post('', 'store') -> name('admin.estados.store');
    Route::get('{state}', 'show') -> name('admin.estados.show');
    Route::get('{state}/edit', 'edit') -> name('admin.estados.edit');
    Route::put('{state}', 'update') -> name('admin.estados.update');
    Route::delete('{state}', 'destroy') -> name('admin.estados.destroy');
});

// RUTAS PARA REGISTROS DE ZONAS
Route::controller(AdminZoneController::class) -> prefix('admin/zones') -> group(function() {
    Route::get('', 'index') -> name('admin.zonas.index');
    Route::get('create', 'create') -> name('admin.zonas.create');
    Route::post('', 'store') -> name('admin.zonas.store');
    Route::get('{zone}', 'show') -> name('admin.zonas.show');
    Route::get('{zone}/edit', 'edit') -> name('admin.zonas.edit');
    Route::put('{zone}', 'update') -> name('admin.zonas.update');
    Route::delete('{zone}', 'destroy') -> name('admin.zonas.destroy');
});

// RUTAS PARA REGISTROS DE USUARIOS
Route::controller(AdminUserController::class) -> prefix('users')-> group(function () {
    Route::get('', 'index')-> name('admin.usuarios.index');
    Route::get('{id}', 'show') -> name('admin.usuarios.show');
    Route::get('edit/{id}', 'edit') -> name('admin.usuarios.edit');
    Route::put('{id}', 'update') -> name('admin.usuarios.update');
});

// RUTAS PARA REGISTROS DE RESEÑAS
Route::controller(AdminReviewController::class) -> prefix('reviews') -> group(function() {
    Route::get('', 'index') -> name('admin.resenias.index');
    Route::get('{resenia}', 'show') -> name('admin.resenias.show');
    Route::delete('{resenia}', 'destroy') -> name('admin.resenias.destroy');
});

