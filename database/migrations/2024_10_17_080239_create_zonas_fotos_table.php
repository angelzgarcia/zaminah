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
        Schema::create('zonas_fotos', function (Blueprint $table) {
            $table -> id('idZonaFoto');
            $table -> string('foto');

            $table -> foreignId('idZonaArqueologica')
                    -> constrained('zonas', 'idZonaArqueologica')
                    -> onDelete('cascade');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zonas_fotos');
    }
};
