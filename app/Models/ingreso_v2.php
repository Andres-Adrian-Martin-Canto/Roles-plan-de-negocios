<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingreso_v2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudio_id',
        'nombre',
        'precio_venta',
        'unidades_mensuales'
    ];

    protected $table = "ingresos_v2";
}
