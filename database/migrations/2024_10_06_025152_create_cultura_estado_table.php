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
        Schema::create('cultura_estado', function (Blueprint $table) {
            $table -> unsignedInteger('idCultura');
            $table -> unsignedInteger('idEstadoRepublica');
            $table -> primary(['idCultura', 'idEstadoRepublica']);

            $table -> foreign('idCultura') -> references('idCultura') -> on('cultura') -> onDelete('cascade');
            $table -> foreign('idEstadoRepublica') -> references('idEstadoRepublica') -> on('estado_republica') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cultura_estado');
    }
};
