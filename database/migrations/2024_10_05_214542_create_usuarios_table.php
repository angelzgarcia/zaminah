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
        Schema::create('usuarios', function (Blueprint $table) {
            $table -> id('idUsuario');
            $table -> unsignedBigInteger('google_id') -> unique();
            $table -> string('nombre', 80);
            $table -> string('genero', 10);
            $table -> string('foto');
            $table -> string('email', 60) -> unique();
            $table -> unsignedBigInteger('numero') -> unique();
            $table -> string('password', 20);
            $table -> string('token', 8);
            $table -> unsignedTinyInteger('confirmado');
            $table -> enum('status', ['activo', 'inactivo']);
            $table -> foreignId('idRol') -> constrained('roles');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
