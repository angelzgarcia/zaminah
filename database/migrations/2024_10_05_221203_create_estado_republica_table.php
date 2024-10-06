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
        Schema::create('estado_republica', function (Blueprint $table) {
            $table -> id('idEstadoRepublica');
            $table -> string('nombre', 30);
            $table -> string('capital', 30);
            $table -> binary('foto');
            $table -> string('video');
            $table -> binary('triptico');
            $table -> binary('guia');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_republica');
    }
};
