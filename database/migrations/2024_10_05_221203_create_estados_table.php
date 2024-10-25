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
        Schema::create('estados', function (Blueprint $table) {
            $table -> id('idEstadoRepublica');
            $table -> string('nombre', 35) -> unique();
            // $table -> string('slug') -> unique();
            $table -> string('capital', 35) -> unique();
            $table -> string('foto');
            $table -> string('video') -> unique();
            $table -> tinyText('triptico');
            $table -> tinyText('guia');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};
