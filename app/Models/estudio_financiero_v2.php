<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudio_financiero_v2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_de_negocio_id',
        'total_gastos_mensuales_mensuales',
        'total_gastos_preoperativos_mensuales',
        'total_gastos_de_articulos_por_venta_mensuales',
        'total_ingresos_mensuales'
    ];

    protected $table = 'estudio_financiero_v2';

    // TODO: Relaciones

    // * Relacion para obtener los gastos Preoperativos mensuales
    public function gastoPreoperativo()
    {
        // * Estoy diciendo que un estudio financiero puede tener varios gastosPreoperativos.
        return $this->hasMany(gasto_preoperativo::class, 'estudio_id');
    }

    // * Relacion para obtener los gastos preoperativos anuales
    public function gastosPreoperativosAnuales()
    {
        return $this->hasMany(gastos_preoperativos_anuales::class, 'estudio_id');
    }

    // * Relacion para obtener los gastos mensuales
    public function gastosMensuales()
    {
        return $this->hasMany(gasto_mensual::class, 'estudio_id');
    }

    // * Relacion para obtener los gastos anuales
    public function gastosAnuales()
    {
        return $this->hasMany(gastos_anuales::class, 'estudio_id');
    }

    // TODO: Relacion de gastos de articulos de venta.
    // * gastos de articulo de venta mensual
    public function gastos_articulos_venta_mensual() {
        return $this->hasMany(gasto_de_articulo_de_venta::class, 'estudio_id');
    }

    // * gastos de articulo de venta anual
    public function gastos_articulos_venta_anuales() {
        return $this->hasMany(gastos_articulo_venta_anuales::class, 'estudio_id');
    }
}
