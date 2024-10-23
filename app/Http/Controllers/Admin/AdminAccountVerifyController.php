<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminAccountVerifyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.Emails.verificarCuenta');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function verify(Request $request)
    {
        $request -> validate([ 'token' => 'required|alpha_num|max:10|min:8']);

        $user = Usuario::where('token', $request -> token)
                        -> where('idRol', 1)
                        -> where('status', 'inactivo')
                        -> first();

        if ($user) {
            // $user -> status = 'activo';
            $user -> confirmado = 1;
            $user -> update();
            return view('admin.Emails.cambiarContrasenia', compact('user'));
        }

        return redirect()
                -> back()
                -> withInput()
                -> withErrors(['token' => 'El token no coincide, intentalo de nuevo.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request -> validate([ 'password' => 'required|string|exists:usuarios,password', 'new_password' => 'required|string']);

        $user = Usuario::where('password', $request -> password)
                            -> where('confirmado', 1)
                            -> where('idRol', 1)
                            -> first();

        if ($user) {
            $user -> password = hashPassword($request -> new_password);
            $user -> status = 'activo';
            $user -> update();
            return view('admin.dashboard', compact('user'));
        }

        return redirect() -> back() -> withInput() -> withErrors(['password' => 'Contraseña incorrecta']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
