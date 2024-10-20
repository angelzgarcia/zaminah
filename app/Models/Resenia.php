<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resenia extends Model
{
    use HasFactory;

    protected $table = 'resenias';
    protected $primaryKey = 'idResenia';

    public function fotos() {
        return $this -> hasMany(ReseniaImagen::class, 'idResenia', 'idResenia');
    }

    public function usuario() {
        return $this -> belongsTo(Usuario::class, 'idUsuario', 'idUsuario');
    }

    public function zona() {
        return $this -> belongsTo(Zona::class, 'idZonaArqueologica', 'idZonaArqueologica');
    }

}
