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
        Schema::create('ingresos_anuales_optimistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_estudio_financiero')->constrained('estudio_financieros','id','idx_ingresos_optimista_estudio_financiero')->onDelete('cascade');
            $table->foreignId('Id_ingresos')->constrained('ingresos')->onDelete('cascade');
            $table->integer('mes');
            $table->float('monto_optimista');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos_anuales_optimistas');
    }
};
