<?php

use App\Http\Controllers\HomeAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



/*      RUTAS   PARA    USUARIOS     */

// RUTA RAIZ
Route::get('/',  HomeController::class) -> name('home-users');





/*      RUTAS   PARA    ADMINISTRADORES      */

// RUTA DASHBOARD ADMIN
Route::get('/dashboard', HomeAdminController::class) -> name('dashboard');

// RUTA DATABASE
Route::get('/database', [HomeAdminController::class, 'database']) -> name('database');
