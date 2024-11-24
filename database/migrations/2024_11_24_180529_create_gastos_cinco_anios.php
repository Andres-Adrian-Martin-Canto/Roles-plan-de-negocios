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
        Schema::create('gastos_cinco_anios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_gasto_mensual');
            $table->foreign('id_gasto_mensual')
                ->references('id')
                ->on('gastos_mensuales')
                ->onDelete('cascade');
            $table->foreignId('estudio_id')->constrained('estudio_financiero_v2')->onDelete('cascade');
            $table->integer('anio');
            $table->decimal('monto', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos_cinco_anios');
    }
};
