<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Mail\VerificarAdminMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Usuario::orderBy('idUsuario', 'desc') -> paginate();

        return view('admin.usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new Usuario();

        $user -> google_id = $request -> google_id ?? null;
        $user -> nombre = $request -> nombre;
        $user -> genero = $request -> genero;

        if ($request -> hasFile('foto')) {
            $user -> foto = basename(time() . '-' . $request -> file('foto') -> store('img/profiles', 'public'));
        } else {
            $avatarsM = [
                0 => 'avatar-m1.jpg',
                1 => 'avatar-m2.jpg',
                2 => 'avatar-m3.jpg',
                3 => 'avatar-m4.jpg',
                4 => 'avatar-m5.jpg',
            ];
            $avatarsW = [
                0 => 'avatar-w1.jpg',
                1 => 'avatar-w2.jpg',
                2 => 'avatar-w3.jpg',
                3 => 'avatar-w4.jpg',
                4 => 'avatar-w5.jpg',
                5 => 'avatar-w6.jpg',
            ];

            $avatarM = $avatarsM[rand(0, count($avatarsM)-1)];
            $avatarW = $avatarsW[rand(0, count($avatarsW)-1)];

            $user -> foto = $request -> genero == 'masculino' ? basename($avatarM) : basename($avatarW);
        }

        $user -> email = $request -> email;
        $user -> numero = $request -> numero;
        $password = hashPassword(Str::password(20, true, true, false, false));
        // // $request -> password != $request -> conf_password ? $user -> password = $request -> conf_password : redirect() -> back() -> withInput() -> withErrors(['password', 'Las contraseñas no coindicen']);
        $user -> password = $password;
        $token = bin2hex(random_bytes(4));
        $user -> token = $token;
        $user -> confirmado = 0;
        $user -> status = 'inactivo';
        $user -> idRol = 1;
        $user -> save();

        Mail::to($request -> email)
                -> send(new VerificarAdminMailable($password, $token));

        return view('admin.usuarios.show', compact('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
