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
        Schema::create('gastos_anuales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_gasto_mensual'); // Agregar la columna
            $table->foreign('id_gasto_mensual') // Crear la clave foránea
                ->references('id') // Columna referenciada
                ->on('gastos_mensuales') // Tabla referenciada
                ->onDelete('cascade'); // Acción al eliminar
            $table->foreignId('estudio_id')->constrained('estudio_financiero_v2')->onDelete('cascade');
            $table->integer('mes');
            $table->decimal('monto', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos_anuales');
    }
};
