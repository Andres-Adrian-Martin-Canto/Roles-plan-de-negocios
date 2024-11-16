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
        Schema::create('gastos_preoperativos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudio_id')->constrained('estudio_financiero_v2','id','fk_gasto_preoperativo_estudio')->onDelete('cascade');
            $table->string('nombre',255);
            $table->decimal('cantidad',10,2);
            $table->decimal('costo_unitario',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos_preoperativos');
    }
};
