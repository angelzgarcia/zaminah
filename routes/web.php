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
});

// RUTAS PARA REGISTROS DE USUARIOS
Route::controller(AdminUserController::class) -> prefix('users')-> group(function () {
    Route::get('', 'index')-> name('admin.users.index');
    Route::get('{id}', 'show') -> name('admin.users.show');
    Route::get('edit/{id}', 'edit') -> name('admin.users.edit');
    Route::put('{id}', 'update') -> name('admin.users.update');
});

// RUTAS PARA REGISTROS DE CULTURAS
Route::controller(AdminCultureController::class) -> prefix('admin/cultures') -> group(function() {
    Route::get('', 'index') -> name('admin.cultures.index');
    Route::get('create', 'create') -> name('admin.cultures.create');
    Route::post('', 'store') -> name('admin.cultures.store');
    Route::get('{culture}', 'show') -> name('admin.cultures.show');
    Route::get('{culture}/edit', 'edit') -> name('admin.cultures.edit');
    Route::put('{culture}', 'update') -> name('admin.cultures.update');
    Route::delete('{culture}', 'destroy') -> name('admin.cultures.destroy');
});

// RUTAS PARA REGISTROS DE ESTADOS
Route::controller(AdminStateController::class) -> prefix('admin/states') -> group(function() {
    Route::get('', 'index') -> name('admin.states.index');
    Route::get('create', 'create') -> name('admin.states.create');
    Route::post('', 'store') -> name('admin.states.store');
    Route::get('{state}', 'show') -> name('admin.states.show');
    Route::get('{state}/edit', 'edit') -> name('admin.states.edit');
    Route::put('{state}', 'update') -> name('admin.states.update');
    Route::delete('{state}', 'destroy') -> name('admin.states.destroy');
});

// RUTAS PARA REGISTROS DE ZONAS
Route::controller(AdminZoneController::class) -> prefix('admin/zones') -> group(function() {
    Route::get('', 'index') -> name('admin.zones.index');
    Route::get('create', 'create') -> name('admin.zones.create');
    Route::post('', 'store') -> name('admin.zones.store');
    Route::get('{zone}', 'show') -> name('admin.zones.show');
    Route::get('{zone}/edit', 'edit') -> name('admin.zones.edit');
    Route::put('{zone}', 'update') -> name('admin.zones.update');
    Route::delete('{zone}', 'destroy') -> name('admin.zones.destroy');
});


// RUTAS PARA REGISTROS DE RESEÑAS
Route::controller(AdminReviewController::class) -> prefix('reviews') -> group(function() {
    Route::get('', 'index') -> name('admin.reviews.index');
    Route::get('{id}', 'show') -> name('admin.reviews.show');
});
