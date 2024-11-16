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
        Schema::create('estudio_financiero_v2', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_de_negocio_id')->unique()->constrained('plan_de_negocios')->onDelete('cascade');
            $table->decimal('total_gastos_mensuales_mensuales',12,2);
            $table->decimal('total_gastos_preoperativos_mensuales',12,2);
            $table->decimal('total_gastos_de_articulos_por_venta_mensuales',12,2);
            $table->decimal('total_ingresos_mensuales',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudio_financiero_v2');
    }
};
