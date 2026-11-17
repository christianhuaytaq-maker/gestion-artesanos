<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Agregamos la columna para el artesano
            // Lo hacemos nullable() para que no falle si hay productos viejos sin artesano
            $table->foreignId('artesano_id')->nullable()->after('id')->constrained('artesanos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['artesano_id']);
            $table->dropColumn('artesano_id');
        });
    }
};
