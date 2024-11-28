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
        Schema::create('vehiculos_mensuales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->decimal('cantidad',8,2);
            $table->decimal('valor_unitario', 10 , 2);
            $table->integer('porcentaje_depreciacion');
            $table->decimal('anio_uno',10,2);
            $table->decimal('anio_dos',10,2);
            $table->decimal('anio_tres',10,2);
            $table->decimal('anio_cuatro',10,2);
            $table->decimal('anio_cinco',10,2);
            $table->foreignId('estudio_id')->constrained('estudio_financiero_v2')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos_mensuales');
    }
};
