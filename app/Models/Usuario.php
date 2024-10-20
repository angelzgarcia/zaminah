<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $primaryKey = 'idUsuario';

    public function rol() {
        return $this -> belongsTo(Rol::class, 'idRol', 'idRol');
    }

    public function resenias() {
        return $this -> hasMany(Resenia::class, 'idUsuario', 'idUsuario');
    }

}
