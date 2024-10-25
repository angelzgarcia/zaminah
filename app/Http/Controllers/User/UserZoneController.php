<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Zona;
use Illuminate\Http\Request;

class UserZoneController extends Controller
{

    public function index() {
        $zonas = Zona::orderBy('nombre', 'asc') -> paginate();

        return view('user.zonas.index', compact('zonas'));
    }

    public function show(Zona $zona)
    {
        if (!$zona) {
            return redirect() -> route('user.zonas.index');
        }

        return view('user.zonas.show', compact('zona'));
    }

}
