<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gastos_articulo_venta_cinco_anios extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_gasto_articulo_venta',
        'estudio_id',
        'anio',
        'monto'
    ];

    protected $table = "gastos_articulo_venta_cinco_anios";
}
