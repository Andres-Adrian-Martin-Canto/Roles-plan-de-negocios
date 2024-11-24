<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gastos_preoperativos_cinco_anios extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_gasto_mensual_preoperativo',
        'estudio_id',
        'anio',
        'monto'
    ];

    protected $table = 'gastos_preoperativos_cinco_anios';
}
