<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gastos_anuales extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_gasto_mensual',
        'estudio_id',
        'mes',
        'monto'
    ];

    protected $table  = 'gastos_anuales';
}
