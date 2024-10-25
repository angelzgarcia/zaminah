<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ContactanosMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserContactUsController extends Controller
{

    public function index()
    {
        return view('user.contactanos.index');
    }

    public function store(Request $request)
    {
        $request -> validate([
            'nombre' => 'required|string|max:40|min:5',
            'correo' => 'required|email',
            'mensaje' => 'required|string|max:300|min:50'
        ]);

        // return $request -> all();

        Mail::to('dimebag121423@gmail.com')
            -> send(new ContactanosMailable($request->all()));

        // session() -> flash('info', 'Mensaje enviado con éxito');
        return redirect() -> route('user.contactanos.index') -> with('info', 'Mensaje enviado con éxito');
    }

}
