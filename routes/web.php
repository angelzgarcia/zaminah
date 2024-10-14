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
    Route::get('dashboard', 'index') -> name('admin.dashboard');
    Route::get('database',  'show_database') -> name('admin.database');
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
    Route::get('{id}', 'show') -> name('admin.cultures.show');
    Route::get('{id}/edit', 'edit') -> name('admin.cultures.edit');
    Route::put('{id}', 'update') -> name('admin.cultures.update');
});

// RUTAS PARA REGISTROS DE ZONAS
Route::controller(AdminZoneController::class) -> prefix('zones') -> group(function() {
    Route::get('', 'index') -> name('admin.zones.index');
    Route::get('create', 'create') -> name('admin.zones.create');

    Route::get('{id}', 'show') -> name('admin.zones.show');
    Route::get('edit/{id}', 'edit') -> name('admin.zones.edit');
    Route::put('{id}', 'update') -> name('admin.zones.update');
});

// RUTAS PARA REGISTROS DE ESTADOS
Route::controller(AdminZoneController::class) -> prefix('states') -> group(function() {
    Route::get('', 'index') -> name('admin.states.index');
    Route::get('create', 'create') -> name('admin.states.create');

    Route::get('{id}', 'show') -> name('admin.states.show');
    Route::get('edit/{id}', 'edit') -> name('admin.states.edit');
    Route::put('{id}', 'update') -> name('admin.states.update');
});

// RUTAS PARA REGISTROS DE RESEÑAS
Route::controller(AdminReviewController::class) -> prefix('reviews') -> group(function() {
    Route::get('', 'index') -> name('admin.reviews.index');
    Route::get('{id}', 'show') -> name('admin.reviews.show');
});
