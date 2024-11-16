<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gasto_preoperativo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cantidad',
        'costo_unitario'
    ];

    protected $table = 'gastos_preoperativos';
}
