<?php

use App\Http\Controllers\Admin\AdminAccountVerifyController;
use App\Http\Controllers\Admin\AdminCultureController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminStateController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminZoneController;
use App\Http\Controllers\User\UserContactUsController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserQuizzController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserCultureController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserReviewController;
use App\Http\Controllers\User\UserStateController;
use App\Http\Controllers\User\UserZoneController;

/*______________________ RUTAS   PARA    USUARIOS ____________________*/

// RUTAS PARA EL INDEX
Route::controller(UserHomeController::class) -> prefix('/') -> group(function() {
    Route::get('', 'index') -> name('home');
    Route::get('mapa-estados', 'show_mapa_estados') -> name('mapa-estados');
    Route::get('mapa-zonas', 'show_mapa_zonas') -> name('mapa-zonas');
    Route::get('nosotros', 'show_nosotros') -> name('nosotros');
});

// RUTAS PARA VISTAS DE ZONAS
Route::controller(UserZoneController::class) -> prefix('zonas') -> group(function() {
    Route::get('', 'index') -> name('user.zonas.index');
    Route::get('{zona}', 'show') -> name('user.zonas.show');
});

// RUTAS PARA VISTAS DE ESTADOS DE LA REPUBLICA
Route::controller(UserStateController::class) -> prefix('estados') -> group(function() {
    Route::get('', 'index') -> name('user.estados.index');
});

// RUTAS PARA VISTAS DE CULTURAS
Route::controller(UserCultureController::class) -> prefix('culturas') -> group(function() {
    Route::get('', 'index') -> name('user.culturas.index');
});

// RUTAS PARA EL PERFIL
Route::controller(UserProfileController::class) -> prefix('profile') -> group(function() {
    Route::get('', 'index') -> name('user.profile.index');
});

// RUTAS PARA EL QUIZZ
Route::controller(UserQuizzController::class) -> prefix('quizz') -> group(function() {
    Route::get('', 'index') -> name('user.quizz.index');
});

// RUTAS PARA EL FORO
Route::controller(UserReviewController::class) -> prefix('foro') -> group(function() {
    Route::get('', 'index') -> name('user.foro.index');
});

// RUTAS PARA EL FORM DE  CONTACTO
Route::controller(UserContactUsController::class) -> prefix('contactanos') -> group(function() {
    Route::get('', 'index') -> name('user.contactanos.index');
    Route::post('', 'store') -> name('user.contactanos.store');
});





/* _____________________ RUTAS   PARA    AUTH __________________*/

// AUTH LOGIN
Route::get('login', [LoginController::class, 'index']) -> name('login');

// AUTH GOOGLE
Route::get('auth/google', [GoogleAuthController::class, 'redirect']) -> name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);





/* _____________________ RUTAS   PARA    ADMINISTRADORES __________________*/

// RUTAS PARA REGISTROS DE CULTURAS
// Route::controller(AdminCultureController::class) -> prefix('admin/cultures') -> group(function() {
//     Route::get('', 'index') -> name('admin.culturas.index');
//     Route::get('create', 'create') -> name('admin.culturas.create');
//     Route::post('', 'store') -> name('admin.culturas.store');
//     Route::get('{culture}', 'show') -> name('admin.culturas.show');
//     Route::get('{culture}/edit', 'edit') -> name('admin.culturas.edit');
//     Route::put('{culture}', 'update') -> name('admin.culturas.update');
//     Route::delete('{culture}', 'destroy') -> name('admin.culturas.destroy');
// });

// RUTAS PARA REGISTROS DE ESTADOS
// Route::controller(AdminStateController::class) -> prefix('admin/states') -> group(function() {
//     Route::get('', 'index') -> name('admin.estados.index');
//     Route::get('create', 'create') -> name('admin.estados.create');
//     Route::post('', 'store') -> name('admin.estados.store');
//     Route::get('{state}', 'show') -> name('admin.estados.show');
//     Route::get('{state}/edit', 'edit') -> name('admin.estados.edit');
//     Route::put('{state}', 'update') -> name('admin.estados.update');
//     Route::delete('{state}', 'destroy') -> name('admin.estados.destroy');
// });

// RUTAS PARA REGISTROS DE ZONAS
// Route::controller(AdminZoneController::class) -> prefix('admin/zones') -> group(function() {
//     Route::get('', 'index') -> name('admin.zonas.index');
//     Route::get('create', 'create') -> name('admin.zonas.create');
//     Route::post('', 'store') -> name('admin.zonas.store');
//     Route::get('{zone}', 'show') -> name('admin.zonas.show');
//     Route::get('{zone}/edit', 'edit') -> name('admin.zonas.edit');
//     Route::put('{zone}', 'update') -> name('admin.zonas.update');
//     Route::delete('{zone}', 'destroy') -> name('admin.zonas.destroy');
// });

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

// RUTAS PARA VERIFICAR LA CUENTA DE UN ADMINISTRADOR
Route::controller(AdminAccountVerifyController::class) -> prefix('verify-admin-account') -> group(function() {
    Route::get('', 'index') -> name('admin.verify_account.index');
    Route::put('',  'verify') -> name('admin.verify_account.verify');
    Route::put('update', 'update') -> name('admin.verify_account.update');
});

// RUTAS PARA REGISTROS DE CULTURAS
Route::resource('admin/culturas', AdminCultureController::class)
        -> parameters(['culturas' => 'culture'])
        -> names('admin.culturas');


// RUTAS PARA REGISTROS DE ESTADOS
Route::resource('admin/estados', AdminStateController::class)
        -> parameters(['estados' => 'state'])
        -> names('admin.estados');

// RUTAS PARA REGISTROS DE ZONAS
Route::resource('admin/zonas', AdminZoneController::class)
        -> parameters(['zonas' => 'zone'])
        -> names('admin.zonas');


// RUTAS PARA REGISTROS DE USUARIOS
Route::controller(AdminUserController::class) -> prefix('admin/users')-> group(function () {
    Route::get('', 'index')-> name('admin.usuarios.index');
    Route::get('create', 'create') -> name('admin.usuarios.create');
    Route::post('', 'store') -> name('admin.usuarios.store');
    Route::get('{user}', 'show') -> name('admin.usuarios.show');
    Route::get('{user}/edit', 'edit') -> name('admin.usuarios.edit');
    Route::put('{user}', 'update') -> name('admin.usuarios.update');
});

// RUTAS PARA REGISTROS DE RESEÑAS
Route::controller(AdminReviewController::class) -> prefix('reviews') -> group(function() {
    Route::get('', 'index') -> name('admin.resenias.index');
    Route::get('{resenia}', 'show') -> name('admin.resenias.show');
    Route::delete('{resenia}', 'destroy') -> name('admin.resenias.destroy');
});

