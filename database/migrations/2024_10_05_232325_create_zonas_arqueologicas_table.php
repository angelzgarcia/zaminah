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
        Schema::create('zona_arqueologica', function (Blueprint $table) {
            $table->id('idZonaArqueologica');
            $table -> string('nombre', 40);
            $table -> binary('foto');
            $table -> string('significado'); //maximo 255 caractere
            $table -> text('descripcion');
            $table -> text('acceso');
            $table -> string('horario', 100);
            $table -> decimal('costoEntrada', 4, 2);
            $table -> string('contacto', 100);
            $table -> foreignId('idEstadoRepublica') -> constrained('estado_republica');
            $table -> foreignId('idUbicacion') -> constrained('ubicacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zona_arqueologica');
    }
};
