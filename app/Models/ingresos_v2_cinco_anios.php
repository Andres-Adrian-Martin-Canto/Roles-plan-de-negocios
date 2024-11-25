<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresos_v2_cinco_anios extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ingresos_anuales',
        'estudio_id',
        'anio',
        'monto'
    ];

    protected $table = "ingresos_v2_cinco_anios";
}
