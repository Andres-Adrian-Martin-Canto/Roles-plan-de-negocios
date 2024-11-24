<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gastos_cinco_anios extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_gasto_mensual',
        'estudio_id',
        'anio',
        'monto'
    ];

    protected $table  = 'gastos_cinco_anios';
}
