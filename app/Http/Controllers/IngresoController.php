<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;
use App\Models\Plan_de_negocio;
use App\Models\EstudioFinanciero;
use Exception;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        //
        $estudio = EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)->first();

        if ($estudio) {
            // Se encontró el estudio financiero, entonces se puede acceder a sus propiedades
            //if ($estudio->ingresos != null) {
                return view('plan_financiero.ingresos', [
                    'plan_de_negocio' => $plan_de_negocio,
                    'ingresos' => $estudio->ingresos,
                    'datosAnuales' => (count($estudio->ingresos_anuales) > 0 || count($estudio->ingresos_pesimistas) > 0 || count($estudio->ingresos_optimista) > 0)
                ]);
            /* } else {
                // Si no hay costos variables, puedes pasar un valor por defecto o manejarlo según tu lógica
                return view('plan_financiero.ingresos', [
                    'plan_de_negocio' => $plan_de_negocio,
                    'ingresos' => [],
                    'datosAnuales' => count($estudio->costos_fijos_anuales) > 0
                ]);
            } */
        } else {
            // No se encontró el estudio financiero, puedes manejar esta situación según tu lógica
            return view('plan_financiero.ingresos', [
                'plan_de_negocio' => $plan_de_negocio,
                'ingresos' => [], // o cualquier otro valor predeterminado
                'datosAnuales' => false
            ]);
        }
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
        $jsonData = $request->json()->all();
        // * Hay que buscar si existe en la tabla estudio financiero si no pues se crea.
        $estudioFinanciero = EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)->first();
        // * Si no existe se crea en la tabla estudio financiero.
        if (!$estudioFinanciero) {
            // * Crear uno nuevo
            $nuevoEstudio = EstudioFinanciero::create([
                'plan_de_negocio_id' => $plan_de_negocio->id,
                'total_costo_fijo' => 0.0,
                'total_costo_variable' => 0.0,
                'total_ingresos' => 0.0,
            ]);
            if ($jsonData[0][0] !== null && $jsonData[0][1] !== null && $jsonData[0][2] !== null && $jsonData[0][4] !== null && $jsonData[0][5] !== null) {
                $ingresos = 0;
                // * Se almacena en la base de datos.
                foreach ($jsonData as $fila) {
                    Ingreso::create([
                        'estudio_financiero_id' => $nuevoEstudio->id,
                        'nombre' => $fila[0],
                        'valor_unitario' => $fila[1],
                        'monto_unitario' => $fila[2],
                        'escenario_conservador' => $fila[3],
                        'escenario_optimista' => $fila[4],
                        'escenario_pesimista' => $fila[5]
                    ]);
                    $ingresos += $fila[3];
                }
                // * Luego modificar el total_costo_fijo.
                EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                    ->update(['total_ingresos' => $ingresos]);
            }
            // TODO: Segunda condicion
        } else {
            if ($jsonData[0][0] === null && $jsonData[0][1] === null && $jsonData[0][2] === null && $jsonData[0][4] === null && $jsonData[0][5] === null) {
                if (Ingreso::where('estudio_financiero_id', $plan_de_negocio->estudioFinanciero->id)->exists()) {
                    Ingreso::where('estudio_financiero_id', $plan_de_negocio->estudioFinanciero->id)->delete();
                    EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                        ->update(['total_ingresos' => 0]);
                }
            } else {
                $ingresos = 0;
                if (Ingreso::where('estudio_financiero_id', $plan_de_negocio->estudioFinanciero->id)->exists()) {
                    Ingreso::where('estudio_financiero_id', $plan_de_negocio->estudioFinanciero->id)->delete();
                    foreach ($jsonData as $fila) {
                        Ingreso::create([
                            'estudio_financiero_id' => $plan_de_negocio->estudioFinanciero->id,
                            'nombre' => $fila[0],
                            'valor_unitario' => $fila[1],
                            'monto_unitario' => $fila[2],
                            'escenario_conservador' => $fila[3],
                            'escenario_optimista' => $fila[4],
                            'escenario_pesimista' => $fila[5]
                        ]);
                        $ingresos += $fila[3];
                    }
                    EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                        ->update(['total_ingresos' => $ingresos]);
                } else {
                    $jsonData = $request->json()->all();
                    $ingresos = 0;
                    foreach ($jsonData as $fila) {
                        Ingreso::create([
                            'estudio_financiero_id' => $plan_de_negocio->estudioFinanciero->id,
                            'nombre' => $fila[0],
                            'valor_unitario' => $fila[1],
                            'monto_unitario' => $fila[2],
                            'escenario_conservador' => $fila[3],
                            'escenario_optimista' => $fila[4],
                            'escenario_pesimista' => $fila[5]
                        ]);
                        $ingresos += $fila[3];
                    }
                    EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                        ->update(['total_ingresos' => $ingresos]);
                }
            }
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(Ingreso $ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingreso $ingreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingreso $ingreso)
    {
        //
    }
}
