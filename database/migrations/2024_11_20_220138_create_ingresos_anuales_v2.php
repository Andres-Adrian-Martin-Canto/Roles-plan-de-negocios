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
        Schema::create('ingresos_anuales_v2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ingresos_anuales');
            $table->foreign('id_ingresos_anuales', 'fk_ingreso_mensual')
                ->references('id')
                ->on('ingresos_v2')
                ->onDelete('cascade');
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
        Schema::dropIfExists('ingresos_anuales_v2');
    }
};
