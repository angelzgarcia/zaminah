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
        Schema::create('culturas_fotos', function(Blueprint $table) {
            $table -> id('idCulturaFoto');
            $table -> string('foto');
            $table -> foreignId('idCultura')
                    -> constrained('culturas')
                    -> onDelete('cascade');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culturas_fotos');
    }
};
