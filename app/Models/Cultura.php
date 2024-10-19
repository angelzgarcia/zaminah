<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cultura extends Model
{
    use HasFactory;

    protected $primaryKey = 'idCultura';

    // ASIGNACION MASIVA

    // CAMPOS PERMITIDOS CON ASIGNACION MASIVA
    // protected $fillable = ['nombre', 'periodo', 'significado', 'descripcion', 'aportaciones'];

    // CAMPOS IGNORADOS CON ASIGNACION MASIVA
    protected $guarded = ['fotos'];

    public function fotos()
    {
        return $this->hasMany(CulturaImagen::class, 'idCultura', 'idCultura');
    }

    public function zonas() {
        return $this -> hasMany(Zona::class, 'idCultura', 'idCultura');
    }

    // MUTADORES Y ACCESORES
    protected function nombre(): Attribute {
        return new Attribute(
            set: fn($name) => strtolower($name),
            get: fn($name) => ucwords($name)
        );
    }

    protected function periodo(): Attribute {
        return new Attribute(
            set: fn($periodo) => strtolower($periodo),
            get: fn($periodo) => ucfirst($periodo)
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

    protected function aportaciones(): Attribute {
        return new Attribute(
            set: fn($aportaciones) => strtolower($aportaciones),
            get: fn($aportaciones) => ucfirst($aportaciones)
        );
    }

}
