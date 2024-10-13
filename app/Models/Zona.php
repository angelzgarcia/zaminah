<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ubicacion;
use Illuminate\Database\Eloquent\Casts\Attribute;

// TABLA / MODELO actual: Zona
// TABLA / MODELO relacionada: Ubicacion

class Zona extends Model
{
    use HasFactory;


    public function ubicacion()
    {
        // relacion uno a uno. una zona TIENE una ubicacion
        // clave foranea en la tabla relacionada (UBICACION) -> FOREIGN DE HAS ONE
        // clave primaria en la tabla actual (ZONA) -> PRIMARY DEL MODELO
        return $this -> hasOne(Ubicacion::class, 'idZonaArqueologica', 'idZonaArqueologica');
    }

    // MUTADORES Y ACCESORES
    protected function nombre(): Attribute {
        return new Attribute(
            set: fn($name) => strtolower($name),
            get: fn($name) => ucwords($name)
        );
    }

    protected function significado(): Attribute {
        return new Attribute(
            set: fn($significado) => strtolower($significado),
            get: fn($significado) => ucfirst($significado)
        );
    }

    protected function descripcion(): Attribute {
        return new Attribute(
            set: fn($descripcion) => strtolower($descripcion),
            get: fn($descripcion) => ucfirst($descripcion)
        );
    }

    protected function acceso(): Attribute {
        return new Attribute(
            set: fn($acceso) => strtolower($acceso),
            get: fn($acceso) => ucfirst($acceso)
        );
    }

    protected function horario(): Attribute {
        return new Attribute(
            set: fn($horario) => strtolower($horario),
            get: fn($horario) => ucfirst($horario)
        );
    }

    protected function contacto(): Attribute {
        return new Attribute(
            set: fn($contacto) => strtolower($contacto),
            get: fn($contacto) => ucfirst($contacto)
        );
    }


}
