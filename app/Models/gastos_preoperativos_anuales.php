<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gastos_preoperativos_anuales extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_gasto_mensual_preoperativo',
        'estudio_id',
        'mes',
        'monto'
    ];

    protected $table = 'gastos_preoperativos_anuales';
}
