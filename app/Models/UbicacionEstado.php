<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UbicacionEstado extends Model
{
    use HasFactory;

    protected $table = 'ubicaciones_estados';
    protected $primaryKey = 'idUbicacionEstado';

    public function estado() {
        return $this -> belongsTo(Estado::class, 'idEstadoRepublica', 'idEstadoRepublica');
    }

}
