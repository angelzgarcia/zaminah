<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Zona;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicaciones';

    public function zona()
    {
        // una ubiaacion ($this) pertenece a una zona
        // relacion uno a uno
        // clave foranea en la tabla ACTUAL (UBICACION) -> FOREIGN DEL MODELO
        // clave primaria en la tabla REALACIONADA (ZONA) -> PRIMARY BELONGS TO
        return $this -> belongsTo(Zona::class, 'idZonaArqueologica', 'idZonaArqueologica');
    }

}
