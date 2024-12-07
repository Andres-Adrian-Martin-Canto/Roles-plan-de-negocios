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
        'total_ingresos_mensuales',
        'total_capital_de_trabajo',
        'total_prestamo'
    ];

    protected $table = 'estudio_financiero_v2';

    // TODO: Relaciones gastos preoperativos

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

    public function gastosPreoperativosCincoAnios() {
        return $this->hasMany(gastos_preoperativos_cinco_anios::class, 'estudio_id');
    }

    // TODO: Gastos
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

    public function gastosCincoAnios()  {
        return $this->hasMany(gastos_cinco_anios::class, 'estudio_id');
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

    public function gastos_articulos_venta_cinco_anios() {
        return $this->hasMany(gastos_articulo_venta_cinco_anios::class, 'estudio_id');
    }

    // TODO: Relacion de ingresos.
    // * Relacion para ingresos mensuales
    public function ingresos_Mensuales() {
        return $this->hasMany(ingreso_v2::class, 'estudio_id');
    }

    //* Relacion para ingresos anuales
    public function ingresos_Anuales() {
        return $this->hasMany(ingresos_anuales_v2::class, 'estudio_id');
    }

    // * Relacion para ingresos cinco anios
    public function ingresoso_Cinco_Anios() {
        return $this->hasMany(ingresos_v2_cinco_anios::class, 'estudio_id');
    }

    // TODO: Relacion para tablas de inversion inicial
    // * Relacion para obtener los bienes inmuebles mensuales
    public function bienes_inmuebles_mensuales()  {
        return $this->hasMany(bienes_inmuebles_mensuales::class, 'estudio_id');
    }
    // * Relacion para obtener los vehiculos mensuales
    public function vehiculos_mensuales() {
        return $this->hasMany(vehiculos_mensuales::class, 'estudio_id');
    }
    // * Relacion para obtener las maquinarias mensuales
    public function maquinarias_mensuales() {
        return $this->hasMany(maquinarias_mensuales::class, 'estudio_id');
    }

    // * Relacion para obtener los mobiliarios mensuales
    public function mobiliario_mensual()  {
        return $this->hasMany(mobiliarios_mensuales::class, 'estudio_id');
    }
}
