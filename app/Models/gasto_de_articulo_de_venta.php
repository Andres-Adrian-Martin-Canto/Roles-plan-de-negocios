<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gasto_de_articulo_de_venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudio_id',
        'nombre',
        'unidades_adquiridas',
        'costo_unitario'
    ];

    protected $table = 'gastos_de_articulos_de_venta';
}
