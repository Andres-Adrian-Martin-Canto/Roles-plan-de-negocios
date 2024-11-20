<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gastos_articulo_venta_anuales extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_gasto_articulo_venta',
        'estudio_id',
        'mes',
        'monto'
    ];

    protected $table = "gastos_de_articulo_de_venta_anuales";
}
