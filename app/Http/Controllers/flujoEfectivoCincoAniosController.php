<?php

namespace App\Http\Controllers;

use App\Models\gasto_de_articulo_de_venta;
use App\Models\gasto_mensual;
use App\Models\gasto_preoperativo;
use App\Models\gastos_articulo_venta_cinco_anios;
use App\Models\gastos_cinco_anios;
use App\Models\gastos_preoperativos_cinco_anios;
use App\Models\ingreso_v2;
use App\Models\ingresos_v2_cinco_anios;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;

class flujoEfectivoCincoAniosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // Obtengo el estudio financiero
        $estudio = $plan_de_negocio->estudioFinancieroV2;
        if (count($estudio->gastosPreoperativosAnuales) < 1 ||
        count($estudio->gastosAnuales) < 1 || count($estudio->gastos_articulos_venta_anuales) < 1
        || count($estudio->ingresos_Anuales) < 1) {
            return redirect()->back()->with('mensaje', 'No se pueden ingresar al balance general a cinco años hasta que ingreses datos anuales.');
        }
        // Variable para saber si el boton aparecera activo o no.
        $botonActivado = false;
        // Variables para almacenar el dato mensual o anual dependiendo.
        // * Gastos Preoperativos
        $dataGastosPreoperativosCincoAnios = [];
        $dataGastosPreoperativoAnuales = [];
        // * Gastos
        $dataGastosCincoAnios = [];
        $dataGastosAnuales = [];
        // * Gastos de Articulos de venta
        $dataGastos_Articulos_Venta_CincoAnios = [];
        $dataGastos_Articulos_Venta_Anuales = [];
        // * Ingresos
        $ingresosAnuales = [];
        $ingresosCincoAnios = [];
        // TODO: Saber si hay gastos operativos cinco anios
        if ($estudio->gastosPreoperativosCincoAnios()->first()) {
            $dataPreoperativo = $estudio->gastosPreoperativosCincoAnios()->orderBy('id_gasto_mensual_preoperativo')->orderBy('anio')->get();
            $id_actual = 0;
            // For each para estructurar el valor
            foreach ($dataPreoperativo as $value) {
                if ($value->id_gasto_mensual_preoperativo !== $id_actual) {
                    // * Obtengo el nombre
                    $name = gasto_preoperativo::find($value->id_gasto_mensual_preoperativo)->nombre;
                    // Le asigno el nuevo id.
                    $id_actual = $value->id_gasto_mensual_preoperativo;
                }
                // Estructuro los valores.
                $dataGastosPreoperativosCincoAnios[$value->id_gasto_mensual_preoperativo][$name][$value->anio] = [$value->id, $value->monto];
            }
        } else { // De lo contrario obtendra los anuales.
            // Boton se activara.
            $botonActivado = true;
            // Obtener los datos anuales.
            $dataPreoperativo = $estudio->gastosPreoperativosAnuales()->orderBy('id_gasto_mensual_preoperativo')->orderBy('mes')->get();
            $montoTotal = 0;
            foreach ($dataPreoperativo as $value) {
                $montoTotal += $value->monto;
                if ($value->mes == 12) {
                    $name = gasto_preoperativo::find($value->id_gasto_mensual_preoperativo)->nombre;
                    $dataGastosPreoperativoAnuales[$value->id_gasto_mensual_preoperativo][$name] = $montoTotal;
                    $montoTotal = 0;
                }
            }
        } // Fin del primer if-else gastos operativos.

        // TODO: Saber si hay gastos de cinco anios.
        if ($estudio->gastosCincoAnios()->first()) {
            $dataGastos = $estudio->gastosCincoAnios()->orderBy('id_gasto_mensual')->orderBy('anio')->get();
            $id_actual = 0;
            foreach ($dataGastos as  $value) {
                // Condicion para saber si hace otra consulta y buscar el nombre.
                if ($value->id_gasto_mensual !== $id_actual) {
                    // Obtengo el nombre
                    $name = gasto_mensual::find($value->id_gasto_mensual)->nombre;
                    $id_actual = $value->id_gasto_mensual;
                }
                // Estructuro los valores.
                $dataGastosCincoAnios[$value->id_gasto_mensual][$name][$value->anio] = [$value->id, $value->monto];
            }
        } else { // De lo contrario obtendra los anuales.
            // Boton se activara.
            $botonActivado = true;
            // Obtener los datos anuales.
            $dataGastos = $estudio->gastosAnuales()->orderBy('id_gasto_mensual')->orderBy('mes')->get();
            $montoTotal = 0;
            foreach ($dataGastos as $value) {
                $montoTotal += $value->monto;
                if ($value->mes == 12) {
                    $name = gasto_mensual::find($value->id_gasto_mensual)->nombre;
                    $dataGastosAnuales[$value->id_gasto_mensual][$name] = $montoTotal;
                    $montoTotal = 0;
                }
            }
        } // Fin del primer if-else gastos


        // TODO: Gastos de articulos de venta cinco anios.
        if ($estudio->gastos_articulos_venta_cinco_anios()->first()) {
            $dataGastosArticulos = $estudio->gastos_articulos_venta_cinco_anios()->orderBy('id_gasto_articulo_venta')->orderBy('anio')->get();
            $id_actual = 0;
            foreach ($dataGastosArticulos as $value) {
                if ($value->id_gasto_articulo_venta !== $id_actual) {
                    // Obtengo el nombre
                    $name = gasto_de_articulo_de_venta::find($value->id_gasto_articulo_venta)->nombre;
                    $id_actual = $value->id_gasto_articulo_venta;
                }
                // Estructuro los valores.
                $dataGastos_Articulos_Venta_CincoAnios[$value->id_gasto_articulo_venta][$name][$value->anio] = [$value->id, $value->monto];
            }
        } else { // * De lo contrario obtendra los anuales Gastos de articulos de venta
            // Boton se activara.
            $botonActivado = true;
            $dataGastosArticulos = $estudio->gastos_articulos_venta_anuales()->orderBy('id_gasto_articulo_venta')->orderBy('mes')->get();
            $montoTotal = 0;
            foreach ($dataGastosArticulos as $value) {
                $montoTotal += $value->monto;
                if ($value->mes == 12) {
                    $name = gasto_de_articulo_de_venta::find($value->id_gasto_articulo_venta)->nombre;
                    $dataGastos_Articulos_Venta_Anuales[$value->id_gasto_articulo_venta][$name] = $montoTotal;
                    $montoTotal = 0;
                }
            }
        } // Fin del primer if-else Gastos de articulos de venta

        // TODO: Ingresos de cinco anios
        if ($estudio->ingresoso_Cinco_Anios()->first()) {
            $dataIngreso = $estudio->ingresoso_Cinco_Anios()->orderBy('id_ingresos_anuales')->orderBy('anio')->get();
            $id_actual = 0;
            foreach ($dataIngreso as $value) {
                if ($value->id_ingresos_anuales !== $id_actual) {
                    $name = ingreso_v2::find($value->id_ingresos_anuales)->nombre;
                    $id_actual = $value->id_ingresos_anuales;
                }
                // Estructuro los valores.
                $ingresosCincoAnios[$value->id_ingresos_anuales][$name][$value->anio] = [$value->id, $value->monto];
            }
        } else { // * De lo contrario obtendra los anuales ingresos.
            // Boton se activara.
            $botonActivado = true;
            $dataIngreso = $estudio->ingresos_Anuales()->orderBy('id_ingresos_anuales')->orderBy('mes')->get();
            $montoTotal = 0;
            foreach ($dataIngreso as  $value) {
                $montoTotal += $value->monto;
                if ($value->mes == 12) {
                    $name = ingreso_v2::find($value->id_ingresos_anuales)->nombre;
                    $ingresosAnuales[$value->id_ingresos_anuales][$name] = $montoTotal;
                    $montoTotal = 0;
                }
            }
        }


        // TODO: Envio de datos a la vista
        return view('plan_financiero.FlujoEfectivoCincoAnios',[
            'titulo' => "Flujo de efectivo cinco años",
            // TODO: Gastos preoperativos
            'dataGastosPreoperativoAnuales' => $dataGastosPreoperativoAnuales,
            'dataGastosPreoperativosCincoAnios' => $dataGastosPreoperativosCincoAnios,
            // TODO: Gastos
            'dataGastosAnuales' => $dataGastosAnuales,
            'dataGastosCincoAnios' => $dataGastosCincoAnios,
            // TODO: Gastos de articulo de venta
            'dataGastos_Articulos_Venta_Anuales' => $dataGastos_Articulos_Venta_Anuales,
            'dataGastos_Articulos_Venta_CincoAnios' => $dataGastos_Articulos_Venta_CincoAnios,
            // TODO: Ingresos
            'ingresosAnuales' => $ingresosAnuales,
            'ingresosCincoAnios' => $ingresosCincoAnios,
            // TODO: Boton se activara
            'botonActivado' => $botonActivado,
            // TODO: RUta dinamica
            'ruta' => route('plan_de_negocio.flujoEfectivoCincoAnios.store', $plan_de_negocio),
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
                gastos_preoperativos_cinco_anios::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'id_gasto_mensual_preoperativo' => $key,
                        'estudio_id' => $estudio->id,
                        'anio' => $i + 1,
                        'monto' => $value[$i][1]
                    ]
                );
            }
        }

        // TODO: Almacenando o actualizando los Gastos
        foreach ($gastos as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                gastos_cinco_anios::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'id_gasto_mensual' => $key,
                        'estudio_id' => $estudio->id,
                        'anio' => $i + 1,
                        'monto' => $value[$i][1]
                    ]
                );
            }
        }

        // TODO: Almacenamos gastos de articulos de venta
        foreach ($GastosArticulosVenta as $key => $value) {
            for ($i=0; $i < count($value); $i++) {
                gastos_articulo_venta_cinco_anios::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'id_gasto_articulo_venta' => $key,
                        'estudio_id' => $estudio->id,
                        'anio' => $i + 1,
                        'monto' => $value[$i][1]
                    ]
                );
            }
        }

        // TODO: Almacenmos los ingresos.
        foreach ($ingresos as $key => $value) {
            for ($i=0; $i < count($value); $i++) {
                ingresos_v2_cinco_anios:: updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'id_ingresos_anuales' => $key,
                        'estudio_id' => $estudio->id,
                        'anio' => $i + 1,
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
