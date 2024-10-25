<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zonas', function (Blueprint $table) {
            $table->id('idZonaArqueologica');
            $table -> string('nombre', 50) -> unique();
            $table -> string('slug') -> unique();
            //MAXIMO 255 CARACTERES
            $table -> string('significado');
            $table -> text('descripcion');
            $table -> text('acceso');
            $table -> string('horario');
            $table -> decimal('costoEntrada', 6, 2);
            $table -> text('contacto');

            // Si se elimina un estado, ubicacion o cultura todas las zonas asociadas a ellos deberian elimianrse:
            $table -> foreignId('idCultura')
            -> constrained('culturas', 'idCultura')
            -> onDelete('cascade');
            $table -> foreignId('idEstadoRepublica')
                    -> constrained('estados', 'idEstadoRepublica')
                    -> onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zonas');
    }
};
