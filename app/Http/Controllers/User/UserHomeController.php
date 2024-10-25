<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{

    public function index() {
        return view('user.home');
    }

    public function show_mapa_estados()
    {
        return view('user.mapa-estados');
    }

    public function show_mapa_zonas()
    {
        return view('user.mapa-zonas');
    }

    public function show_nosotros()
    {
        return view('user.nosotros');
    }

}
