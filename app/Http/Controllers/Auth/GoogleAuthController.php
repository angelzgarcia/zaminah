<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{

    public function redirect() {
        return Socialite::driver('google') -> redirect();
    }

    public function callbackGoogle() {
        try {
            $google_user = Socialite::driver('google') -> user();

            $user = Usuario::where('google_id', $google_user -> getId())
                            -> where('email', $google_user -> getEmail())
                            -> first();

            if (!$user):
                $new_user = Usuario::createOrUpdate([
                    'google_id' => $google_user -> getId(),
                    'nombre' => $google_user -> getName(),
                    'genero' => null,
                    'foto' => $google_user -> getAvatar(),
                    'email' => $google_user -> getEmail(),
                    'numero' => null,
                    'password' => null,
                    'token' => null,
                    'confirmado' => 1,
                    'status' => 'activo',
                    'idRol' => 2,
                ]);

                Auth::login($new_user);

                return redirect() -> intended('profile');

            else:
                Auth::login($user);

                if ($user->confirmado == 1 && $user->status == 'activo' && $user->idRol == 2) {
                    return redirect() -> intended('admin/dashboard');
                }

                return redirect() -> intended('profile');
            endif;

        } catch (\Throwable $th) {
            dd('Ocurrió un error ' . $th -> getMessage());
        }
    }

}
