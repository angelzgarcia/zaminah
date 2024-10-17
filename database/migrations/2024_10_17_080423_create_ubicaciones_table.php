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
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table -> id('idUbicacion');
            $table -> decimal('latitud', 6, 3) -> unique();
            $table -> decimal('longitud', 6, 3) -> unique();
            $table -> foreignId('idZonaArqueologica')
                    -> unique()
                    -> constrained('zonas', 'idZonaArqueologica')
                    -> onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicaciones');
    }
};
