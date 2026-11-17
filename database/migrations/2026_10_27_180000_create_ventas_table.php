<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();

            // Relación con productos
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');

            // Relación con usuarios (tu tabla se llama 'usuarios')
            $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');

            $table->string('dni_cliente')->nullable();
            $table->integer('cantidad')->default(1);
            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
