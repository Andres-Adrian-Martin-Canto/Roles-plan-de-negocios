<?php

namespace App\Http\Controllers;

use App\Models\gasto_de_articulo_de_venta;
use App\Models\gasto_mensual;
use App\Models\gasto_preoperativo;
use App\Models\gastos_anuales;
use App\Models\gastos_articulo_venta_anuales;
use App\Models\gastos_preoperativos_anuales;
use App\Models\ingreso_v2;
use App\Models\ingresos_anuales_v2;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;

class balanceGeneralAnualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // Obtengo el estudio financiero
        $estudio = $plan_de_negocio->estudioFinancieroV2;
        // TODO: Condicion de que si no existe algun apartado entoces regresara un mensaje de error.
        if (count($estudio->gastoPreoperativo) < 1 || count($estudio->gastosMensuales) < 1 || count($estudio->gastos_articulos_venta_mensual) < 1 || count($estudio->ingresos_Mensuales) < 1) {
            return redirect()->back()->with('mensaje', 'No se pueden ingresar al balance general anual hasta que ingreses datos de cada apartado.');
        }
        // Variable para saber si el boton aparecera activo o no.
        $botonActivado = false;
        // Variables para almacenar el dato mensual o anual dependiendo.
        // * Gastos Preoperativos
        $dataGastosPreoperativosMensuales = [];
        $dataGastosPreoperativoAnuales = [];
        // * Gastos
        $dataGastosMensuales = [];
        $dataGastosAnuales = [];
        // * Gastos de Articulos de venta
        $dataGastos_Articulos_Venta_Mensuales = [];
        $dataGastos_Articulos_Venta_Anuales = [];
        // * Ingresos
        $ingresosAnuales = [];
        $ingresosMensuales = [];
        // Saber si hay gastos operativos anuales
        if ($estudio->gastosPreoperativosAnuales()->first()) {
            // Obtengo los datos anuales
            $dataPreoperativo = $estudio->gastosPreoperativosAnuales()->orderBy('id_gasto_mensual_preoperativo')->orderBy('mes')->get();
            // Variable que me ayudara a no repetir la consulta.
            $id_actual = 0;
            // For para estructurar el valor
            foreach ($dataPreoperativo as $value) {
                // Si el id_actual es difente al id_gasto_mensual_preoperativo entonces entrara y hara la consulta.
                if ($value->id_gasto_mensual_preoperativo !== $id_actual) {
                    // * Obtengo el nombre
                    $name = gasto_preoperativo::find($value->id_gasto_mensual_preoperativo)->nombre;
                    // Le asigno el nuevo id.
                    $id_actual = $value->id_gasto_mensual_preoperativo;
                }
                // Estructuro los valores.
                $dataGastosPreoperativoAnuales[$value->id_gasto_mensual_preoperativo][$name][$value->mes] = [$value->id, $value->monto];
            }
        } else { //  De lo contrario obtendre los gastos preoperativos mensuales.
            // Boton se activara.
            $botonActivado = true;
            // Obtener los datos mensuales.
            $dataPreoperativo = $estudio->gastoPreoperativo;
            foreach ($dataPreoperativo as $value) {
                array_push($dataGastosPreoperativosMensuales, [$value->id, $value->nombre, $value->cantidad * $value->costo_unitario]);
            }
        }


        // Saber si hay gastos anuales
        if ($estudio->gastosAnuales()->first()) {
            // * Variable que me ayudara a no repetir la consulta.
            $id_actual = 0;
            // Obtengo los gastosAnuales.
            $dataGasto =  $estudio->gastosAnuales()->orderBy('id_gasto_mensual')->orderBy('mes')->get();
            // Foreach para estructurar los datos.
            foreach ($dataGasto as $value) {
                // Condicion para saber si hace otra consulta y buscar el nombre.
                if ($value->id_gasto_mensual !== $id_actual) {
                    // Obtengo el nombre
                    $name = gasto_mensual::find($value->id_gasto_mensual)->nombre;
                    $id_actual = $value->id_gasto_mensual;
                }
                // Estructurando los valores.
                $dataGastosAnuales[$value->id_gasto_mensual][$name][$value->mes] = [$value->id, $value->monto];
            }
        } else { // De lo contrario obtendra los datos mensuales
            // Boton se activara.
            $botonActivado = true;
            // Obtengo los gastos mensuales.
            $dataGasto = $estudio->gastosMensuales;
            foreach ($dataGasto as $value) {
                array_push($dataGastosMensuales, [$value->id, $value->nombre, $value->unidad * $value->monto_unitario]);
            }
        }

        // Saber si hay gastos de articulos de venta
        if ($estudio->gastos_articulos_venta_anuales()->first()) {
            // * Variable que me ayudara a no repetir la consulta.
            $id_actual = 0;
            // Obtengo los gastos de articulo de venta, organizado por el id y por el mes
            $dataVentas = $estudio->gastos_articulos_venta_anuales()->orderBy('id_gasto_articulo_venta')->orderBy('mes')->get();
            // For para estructurar los datos
            foreach ($dataVentas as $value) {
                // Condicion para saber si tiene que buscar de nuevo otro nombre
                if ($value->id_gasto_articulo_venta !== $id_actual) {
                    // Obtengo el nombre
                    $name = gasto_de_articulo_de_venta::find($value->id_gasto_articulo_venta)->nombre;
                    // Cambio el id.
                    $id_actual = $value->id_gasto_articulo_venta;
                }
                // Estructuro los datos.
                $dataGastos_Articulos_Venta_Anuales[$value->id_gasto_articulo_venta][$name][$value->mes] = [$value->id, $value->monto];
            }
        } else { // De lo contrario obtendra los gastos de articulos de venta mensuales.
            // Boton se activara.
            $botonActivado = true;
            $dataVentas = $estudio->gastos_articulos_venta_mensual;
            foreach ($dataVentas as $value) {
                array_push($dataGastos_Articulos_Venta_Mensuales, [$value->id, $value->nombre, $value->unidades_adquiridas * $value->costo_unitario]);
            }
        }


        // Saber si hay ingresos anuales
        if ($estudio->ingresos_Anuales()->first()) {
            // * Variable que me ayudara a no repetir la consulta.
            $id_actual = 0;
            $dataIngreso = $estudio->ingresos_Anuales()->orderBy('id_ingresos_anuales')->orderBy('mes')->get();
            // For para estructurar los datos
            foreach ($dataIngreso as $value) {
                // Condicion para saber si tiene que buscar de nuevo otro nombre
                if ($value->id_ingresos_anuales !== $id_actual) {
                    // Obtengo el nombre
                    $name = ingreso_v2::find($value->id_ingresos_anuales)->nombre;
                    // Cambio el id.
                    $id_actual = $value->id_ingresos_anuales;
                }
                // Estructuro los datos.
                $ingresosAnuales[$value->id_ingresos_anuales][$name][$value->mes] = [$value->id, $value->monto];
            }
        } else { // De lo contrario obtendra los ingresos mensuales.
            // Boton se activara.
            $botonActivado = true;
            $dataIngreso = $estudio->ingresos_Mensuales;
            foreach ($dataIngreso as $value) {
                array_push($ingresosMensuales, [$value->id, $value->nombre, $value->precio_venta * $value->unidades_mensuales]);
            }
        }
        // * Envio de datos a la vista.
        return view('plan_financiero.FlujoEfectivoAnual', [
            'titulo' => "Flujo de efectivo anual",
            // TODO: Gastos preoperativos
            'dataGastosPreoperativoAnuales' => $dataGastosPreoperativoAnuales,
            'dataGastosPreoperativosMensuales' => $dataGastosPreoperativosMensuales,
            // TODO: Gastos
            'dataGastosAnuales' => $dataGastosAnuales,
            'dataGastosMensuales' => $dataGastosMensuales,
            // TODO: Gastos de articulo de venta
            'dataGastos_Articulos_Venta_Anuales' => $dataGastos_Articulos_Venta_Anuales,
            'dataGastos_Articulos_Venta_Mensuales' => $dataGastos_Articulos_Venta_Mensuales,
            // TODO: Ingresos
            'ingresosAnuales' => $ingresosAnuales,
            'ingresosMensuales' => $ingresosMensuales,
            // TODO: Boton se activara
            'botonActivado' => $botonActivado,
            // TODO: RUta dinamica
            'ruta' => route('plan_de_negocio.flujoEfectivoAnual.store', $plan_de_negocio),
            'plan_de_negocio' => $plan_de_negocio
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        $estudio = $plan_de_negocio->estudioFinancieroV2;
        $estructuraConvertida = json_decode($request->getContent(), true);
        $GastosPreoperativos = $estructuraConvertida[0];
        $gastos = $estructuraConvertida[1];
        $GastosArticulosVenta = $estructuraConvertida[2];
        $ingresos = $estructuraConvertida[3];
        // TODO: Almacenando o actualizando los Gastos Preoperativos
        foreach ($GastosPreoperativos as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                gastos_preoperativos_anuales::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'id_gasto_mensual_preoperativo' => $key,
                        'estudio_id' => $estudio->id,
                        'mes' => $i + 1,
                        'monto' => $value[$i][1]
                    ]
                );
            }
        }

        // TODO: Almacenando o actualizando los Gastos
        foreach ($gastos as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                gastos_anuales::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'id_gasto_mensual' => $key,
                        'estudio_id' => $estudio->id,
                        'mes' => $i + 1,
                        'monto' => $value[$i][1]
                    ]
                );
            }
        }

        // TODO: Almacenamos gastos de articulos de venta
        foreach ($GastosArticulosVenta as $key => $value) {
            for ($i=0; $i < count($value); $i++) {
                gastos_articulo_venta_anuales::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'id_gasto_articulo_venta' => $key,
                        'estudio_id' => $estudio->id,
                        'mes' => $i + 1,
                        'monto' => $value[$i][1]
                    ]
                );
            }
        }

        // TODO: Almacenmos los ingresos.
        foreach ($ingresos as $key => $value) {
            for ($i=0; $i < count($value); $i++) {
                ingresos_anuales_v2:: updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'id_ingresos_anuales' => $key,
                        'estudio_id' => $estudio->id,
                        'mes' => $i + 1,
                        'monto' => $value[$i][1]
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
