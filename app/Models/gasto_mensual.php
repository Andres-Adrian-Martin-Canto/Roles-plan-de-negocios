<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gasto_mensual extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'unidad',
        'monto_unitario'
    ];

    protected $table = 'gastos_mensuales';

    // * Relaciones
}
