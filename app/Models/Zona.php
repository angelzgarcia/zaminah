<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ubicacion;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

// TABLA / MODELO actual: Zona
// TABLA / MODELO relacionada: Ubicacion

class Zona extends Model
{
    use HasFactory;

    protected $primaryKey = 'idZonaArqueologica';

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function($zona) {
            if (!$zona->slug) {
                $zona->slug = Str::slug($zona->nombre, '-');
            }
        });
    }


    // relacion uno a uno. una zona TIENE una ubicacion
    // clave foranea en la tabla relacionada (UBICACION) -> FOREIGN DE HAS ONE
    // clave primaria en la tabla actual (ZONA) -> PRIMARY DEL MODELO
    public function ubicacion()
    {
        return $this -> hasOne(UbicacionZona::class, 'idZonaArqueologica', 'idZonaArqueologica');
    }

    public function estados() {
        return $this -> belongsTo(Estado::class, 'idEstadoRepublica', 'idEstadoRepublica');
    }

    public function culturas() {
        return $this -> belongsTo(Cultura::class, 'idCultura', 'idCultura');
    }

    public function fotos() {
        return $this -> hasMany(ZonaImagen::class, 'idZonaArqueologica', 'idZonaArqueologica');
    }

    public function resenias() {
        return $this -> hasMany(Resenia::class, 'idZonaArqueologica', 'idZonaArqueologica');
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
