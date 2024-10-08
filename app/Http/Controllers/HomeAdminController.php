<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function __invoke() {
        return view('admin.dashboard');
    }

    public function database() {
        return view('admin.database');
    }

}
