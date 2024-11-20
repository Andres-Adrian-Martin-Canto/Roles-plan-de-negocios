<?php

namespace App\Http\Controllers;

use App\Models\estudio_financiero_v2;
use App\Models\gasto_mensual;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class gastosMensualesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // Obtener el estudio financiero.
        $estudio = $plan_de_negocio->estudioFinancieroV2;
        $columnaPrincipal = "Nombre";
        $columnaSecundaria = "Unidad";
        $columnaTercera = "Monto unitario";
        $columnaCuarta = "Total";
        // * Pregunta si no existe el estudio entonces lo va a crear.
        if (!$estudio) {
            estudio_financiero_v2::create([
                'plan_de_negocio_id' => $plan_de_negocio->id,
                'total_gastos_mensuales_mensuales' => 0,
                'total_gastos_preoperativos_mensuales' => 0,
                'total_gastos_de_articulos_por_venta_mensuales' => 0,
                'total_ingresos_mensuales' => 0
            ]);
        }
        // * retorna la vista y envia los valores.
        return view('plan_financiero.plantillaMensualesV2', [
            'columnaPrincipal' => $columnaPrincipal,
            'columnaSecundaria' => $columnaSecundaria,
            'columnaTercera' => $columnaTercera,
            'columnaCuarta' => $columnaCuarta,
            'url' => route('plan_de_negocio.gastosMensuales.store', $plan_de_negocio),
            'datos' => $estudio->gastosMensuales->toArray(),
            'datos_anuales' => $estudio->gastosAnuales,
            'plan_de_negocio' => $plan_de_negocio,
            'titulo' => 'Gastos Mensuales'
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
        // Obtengo el id del estudioFinanciero.
        $json = $request->json()->all();
        $estudio = $plan_de_negocio->estudioFinancieroV2;
        $estudio->gastosMensuales()->delete();
        $totalDeGastosPreoperativos = 0;
        if ($json[0][0] !== null) {
            foreach ($json as $datoNuevo) {
                gasto_mensual::create([
                    'estudio_id' => $estudio->id,
                    'nombre' => $datoNuevo[0],
                    'unidad' => $datoNuevo[1],
                    'monto_unitario' => $datoNuevo[2]
                ]);
                $totalDeGastosPreoperativos += $datoNuevo[3];
            }
            $estudio->total_gastos_mensuales_mensuales = $totalDeGastosPreoperativos;
            $estudio->save();
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
