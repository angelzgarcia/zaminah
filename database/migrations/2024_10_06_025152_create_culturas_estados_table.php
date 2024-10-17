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
        Schema::create('culturas_estados', function (Blueprint $table) {
            $table -> id('idCulturaEstado');
            // $table -> unsignedInteger('idCultura');
            // $table -> unsignedInteger('idEstadoRepublica');
            // $table -> primary(['idCultura', 'idEstadoRepublica']);
            $table -> foreignId('idCultura')
                    -> constrained('culturas', 'idCultura')
                    -> onDelete('cascade');
            $table -> foreignId('idEstadoRepublica')
                    -> constrained('estados', 'idEstadoRepublica')
                    -> onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culturas_estados');
    }
};
