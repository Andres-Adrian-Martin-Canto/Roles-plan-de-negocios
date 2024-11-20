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
        Schema::create('gastos_preoperativos_anuales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_gasto_mensual_preoperativo');
            $table->foreign('id_gasto_mensual_preoperativo', 'fk_gasto_mensual_preoperativo')
                ->references('id')
                ->on('gastos_preoperativos')
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
        Schema::dropIfExists('gastos_preoperativos_anuales');
    }
};
