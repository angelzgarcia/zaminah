<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CulturaImagen extends Model
{
    use HasFactory;

    protected $table = 'culturas_fotos';
    protected $primaryKey = 'idCulturaFoto';

    public function culturas() {
        return $this -> belongsTo(Cultura::class, 'idCultura', 'idCultura');
    }

}
