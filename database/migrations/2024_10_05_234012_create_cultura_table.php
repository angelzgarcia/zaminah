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
        Schema::create('cultura', function (Blueprint $table) {
            $table->id('idCultura');
            $table -> string('nombre', 30) -> unique();
            $table -> string('periodo', 50);
            $table -> string('significado');
            $table -> text('descripcion');
            $table -> binary('foto');
            $table -> string('aportaciones');
            $table -> foreignId('idEstadoRepublica') -> constrained('estado_republica');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cultura');
    }
};
