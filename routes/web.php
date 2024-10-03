<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(HomeController::class) -> group(function(){
    Route::get('estados', '');
});

Route::get('/',  HomeController::class);

Route::get('/dashboard', [HomeController::class, 'adminDashboard']);
