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
            $table -> string('google_id') -> nullable() -> unique();
            $table -> string('nombre', 80);
            $table -> string('genero', 10) -> nullable();
            $table -> string('foto') -> nullable();
            $table -> string('email', 60) -> unique();
            $table -> unsignedBigInteger('numero') -> nullable() -> unique();
            $table -> string('password') -> nullable();
            $table -> string('token', 10) -> nullable();
            $table -> boolean('confirmado') -> default(0);
            $table -> enum('status', ['activo', 'inactivo']);

            $table -> foreignId('idRol')
                    -> constrained('roles', 'idRol')
                    -> onDelete('cascade');

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
