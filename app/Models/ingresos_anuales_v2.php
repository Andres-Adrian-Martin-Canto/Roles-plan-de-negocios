<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresos_anuales_v2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ingresos_anuales',
        'estudio_id',
        'mes',
        'monto'
    ];

    protected $table = "ingresos_anuales_v2";
}
