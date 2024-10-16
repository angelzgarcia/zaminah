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
        Schema::create('culturas', function (Blueprint $table) {
            $table->id('idCultura');
            $table -> string('nombre', 30) -> unique();
            $table -> string('periodo', 60);
            $table -> string('significado');
            $table -> text('descripcion');
            // $table -> binary('foto');
            $table -> text('aportaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culturas');
    }
};
