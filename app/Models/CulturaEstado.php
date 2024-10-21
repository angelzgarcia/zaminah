<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CulturaEstado extends Model
{
    use HasFactory;

    protected $table = 'culturas_estados';
    protected $primaryKey = 'idCulturaEstado';

    public function cultura() {
        return $this -> belongsTo(Cultura::class, 'idCultura', 'idCultura');
    }

    public function estado() {
        return $this -> belongsTo(Estado::class, 'idEstadoRepublica', 'idEstadoRepublica');
    }

}
