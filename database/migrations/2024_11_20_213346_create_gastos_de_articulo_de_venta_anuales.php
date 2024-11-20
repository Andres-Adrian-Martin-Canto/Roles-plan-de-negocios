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
        Schema::create('gastos_de_articulo_de_venta_anuales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_gasto_articulo_venta');
            $table->foreign('id_gasto_articulo_venta', 'fk_gasto_articulo_venta_mensual')
                ->references('id')
                ->on('gastos_de_articulos_de_venta')
                ->onDelete('cascade');
            $table->unsignedBigInteger('estudio_id');
            $table->foreign('estudio_id')
                ->references('id')
                ->on('estudio_financiero_v2')
                ->onDelete('cascade');
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
        Schema::dropIfExists('gastos_de_articulo_de_venta_anuales');
    }
};
