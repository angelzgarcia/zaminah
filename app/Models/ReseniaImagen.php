<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReseniaImagen extends Model
{
    use HasFactory;

    protected $table = 'resenias_fotos';
    protected $primaryKey = 'idReseniaFoto';

    public function resenia() {
        return $this -> belongsTo(Resenia::class, 'idResenia', 'idResenia');
    }

}
