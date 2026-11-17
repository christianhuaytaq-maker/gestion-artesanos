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
        Schema::create('artesanos', function (Blueprint $table) {
            $table->id();

            // Relación con el usuario que iniciará sesión (opcional pero recomendada)
            // $table->foreignId('user_id')->nullable()->constrained('usuarios')->onDelete('cascade');

            // Campos de tu modelo Artesano
            $table->string('dni')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('especialidad');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artesanos');
    }
};
