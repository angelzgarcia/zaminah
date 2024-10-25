<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Usuario extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'idUsuario';
    protected $guarded = [];

    public function rol() {
        return $this -> belongsTo(Rol::class, 'idRol', 'idRol');
    }

    public function resenias() {
        return $this -> hasMany(Resenia::class, 'idUsuario', 'idUsuario');
    }

    // MUTADORES Y ACCESORES
    public function nombre() {
        return new Attribute(
            set: fn($nombre) => strtolower($nombre),
            get: fn($nombre) => ucwords($nombre)
        );
    }

    public function genero() {
        return new Attribute(
            set: fn($genero) => strtolower($genero),
            get: fn($genero) => ucwords($genero)
        );
    }

    public function status() {
        return new Attribute(
            set: fn($status) => strtolower($status),
            get: fn($status) => ucwords($status)
        );
    }

}
