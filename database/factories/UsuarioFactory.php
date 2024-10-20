<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Rol;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dir =  storage_path('app/public/imgs_fake');

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        return [
            'google_id' => fake() -> unique() -> randomNumber(8, true),
            'nombre' => fake() -> name(),
            'genero' => fake() -> randomElement(['Masculino', 'Femenino']),
            'foto' => fake() -> image($dir, 640, 480, null, true),
            'email' => fake() -> unique() -> safeEmail(),
            'numero' => fake() -> unique() -> e164PhoneNumber(),
            'password' => static::$password ??= Hash::make('password'),
            'token' => Str::random(10),
            'confirmado' => fake() -> randomElement([0,1]),
            'status' => fake() -> randomElement(['activo', 'inactivo']),

            'idRol' => Rol::inRandomOrder()
                    -> first()
                    -> idRol,
        ];
    }
}
