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
        Schema::create('resenias', function (Blueprint $table) {
            $table->id('idResenia');
            $table -> string('mensaje');
            $table -> unsignedTinyInteger('puntuacion');
            // $table -> binary('foto');
            $table -> foreignId('idUsuario') -> constrained('usuario');
            $table -> foreignId('idZonaArqueologica') -> constrained('zonas_arqueologicas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenias');
    }
};
