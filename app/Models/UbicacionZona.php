<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UbicacionZona extends Model
{
    use HasFactory;

    protected $table = 'ubicaciones_zonas';
    protected $primaryKey = 'idUbicacionZona';

    public function zona() {
        return $this -> belongsTo(Zona::class, 'idZonaArqueologica', 'idZonaArqueologica');
    }

}
