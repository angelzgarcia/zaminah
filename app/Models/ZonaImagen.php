<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZonaImagen extends Model
{
    use HasFactory;

    protected $table = 'zonas_fotos';

    protected $primaryKey = 'idZonaFoto';

    public function zona() {
        return $this -> belongsTo(Zona::class, 'idZonaArqueologica', 'idZonaArqueologica');
    }

}
