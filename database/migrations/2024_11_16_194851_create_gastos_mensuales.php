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
        Schema::create('gastos_mensuales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudio_id')->constrained('estudio_financiero_v2','id','fk_gasto_estudio')->onDelete('cascade');
            $table->string('nombre',255);
            $table->decimal('unidad',10,2);
            $table->decimal('monto_unitario',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos_mensuales');
    }
};
