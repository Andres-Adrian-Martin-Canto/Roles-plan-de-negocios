<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudio_financiero_v2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_gastos_mensuales_mensuales',
        'total_gastos_preoperativos_mensuales',
        'total_gastos_de_articulos_por_venta_mensuales',
        'total_ingresos_mensuales'
    ];

    protected $table = 'estudio_financiero_v2';

    // * Relaciones
}
