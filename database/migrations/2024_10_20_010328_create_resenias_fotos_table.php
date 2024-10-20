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
        Schema::create('resenias_fotos', function (Blueprint $table) {
            $table -> id('idReseniaFoto');
            $table -> string('foto');
            
            $table -> foreignId('idResenia')
                    -> constrained('resenias', 'idResenia')
                    -> onDelete('cascade');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenias_fotos');
    }
};
