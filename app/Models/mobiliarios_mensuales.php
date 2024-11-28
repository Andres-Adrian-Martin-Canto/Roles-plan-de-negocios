<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobiliarios_mensuales extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cantidad',
        'valor_unitario',
        'porcentaje_depreciacion',
        'anio_uno',
        'anio_dos',
        'anio_tres',
        'anio_cuatro',
        'anio_cinco',
        'estudio_id'
    ];

    protected $table = 'mobiliarios_mensuales';
}
