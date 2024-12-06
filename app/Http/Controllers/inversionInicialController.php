<?php

namespace App\Http\Controllers;

use App\Models\bienes_inmuebles_mensuales;
use App\Models\estudio_financiero_v2;
use App\Models\maquinarias_mensuales;
use App\Models\mobiliarios_mensuales;
use App\Models\Plan_de_negocio;
use App\Models\vehiculos_mensuales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class inversionInicialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // * Si existe un estudio entonces entrara aqui.
        $estudio = $plan_de_negocio->estudioFinancieroV2;
        if (!$estudio) {
            $estudio = estudio_financiero_v2::create([
                'plan_de_negocio_id' => $plan_de_negocio->id,
                'total_gastos_mensuales_mensuales' => 0,
                'total_gastos_preoperativos_mensuales' => 0,
                'total_gastos_de_articulos_por_venta_mensuales' => 0,
                'total_ingresos_mensuales' => 0
            ]);
        }
        $bienes = $estudio->bienes_inmuebles_mensuales;
        $vehiculos = $estudio->vehiculos_mensuales;
        $maquinarias = $estudio->maquinarias_mensuales;
        $mobiliarios = $estudio->mobiliario_mensual;
        $url = route('plan_de_negocio.inversionInicial.store', $plan_de_negocio);
        // !!! Esta mal porque tienen que ser los anuales.
        $hayDatos = $bienes->count() > 0 || $vehiculos->count() > 0 || $maquinarias->count() > 0 || $mobiliarios->count() > 0;
        return view('plan_financiero.inversionInicial', compact('plan_de_negocio', 'estudio', 'bienes', 'vehiculos', 'maquinarias', 'mobiliarios', 'url', 'hayDatos'));
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
        //
        // Log::info($request->all());

        $estudio = $plan_de_negocio->estudioFinancieroV2;
        // Borrar los bienes inmuebles mensuales
        $estudio->bienes_inmuebles_mensuales()->delete();
        // Borrar los vehiculos mensuales
        $estudio->vehiculos_mensuales()->delete();
        // Borrar las maquinarias mensuales
        $estudio->maquinarias_mensuales()->delete();
        // Borrar los mobiliarios mensuales
        $estudio->mobiliario_mensual()->delete();
        // Crear los nuevos datos
        $estructuraConvertida = json_decode($request->getContent(), true);
        $mobiliarios = $estructuraConvertida[0];
        $maquinarias = $estructuraConvertida[1];
        $vehiculos = $estructuraConvertida[2];
        $bienes = $estructuraConvertida[3];

        // * Guardar los datos en la base de datos de MOBILIARIOS
        if ($mobiliarios[0][1] !== "" && $mobiliarios[0][1] !== null) {
            foreach ($mobiliarios as $mobiliario) {
                mobiliarios_mensuales::create([
                    'nombre' => $mobiliario[0],
                    'cantidad' => $mobiliario[1],
                    'valor_unitario' => $mobiliario[2],
                    'porcentaje_depreciacion' => $mobiliario[4],
                    'anio_uno' => $mobiliario[6],
                    'anio_dos' => $mobiliario[7],
                    'anio_tres' => $mobiliario[8],
                    'anio_cuatro' => $mobiliario[9],
                    'anio_cinco' => $mobiliario[10],
                    'estudio_id' => $estudio->id
                ]);
            }
        }

        // * Guardar los datos en la base de datos de MAQUINARIAS
        if ($maquinarias[0][1] !== "" && $maquinarias[0][1] !== null) {
            foreach ($maquinarias as $maquinaria) {
                maquinarias_mensuales::create([
                    'nombre' => $maquinaria[0],
                    'cantidad' => $maquinaria[1],
                    'valor_unitario' => $maquinaria[2],
                    'porcentaje_depreciacion' => $maquinaria[4],
                    'anio_uno' => $maquinaria[6],
                    'anio_dos' => $maquinaria[7],
                    'anio_tres' => $maquinaria[8],
                    'anio_cuatro' => $maquinaria[9],
                    'anio_cinco' => $maquinaria[10],
                    'estudio_id' => $estudio->id
                ]);
            }
        }

        // * Guardar los datos en la base de datos de VEHICULOS
        if ($vehiculos[0][1] !== "" && $vehiculos[0][1] !== null) {
            foreach ($vehiculos as $vehiculo) {
                vehiculos_mensuales::create([
                    'nombre' => $vehiculo[0],
                    'cantidad' => $vehiculo[1],
                    'valor_unitario' => $vehiculo[2],
                    'porcentaje_depreciacion' => $vehiculo[4],
                    'anio_uno' => $vehiculo[6],
                    'anio_dos' => $vehiculo[7],
                    'anio_tres' => $vehiculo[8],
                    'anio_cuatro' => $vehiculo[9],
                    'anio_cinco' => $vehiculo[10],
                    'estudio_id' => $estudio->id
                ]);
            }
        }

        // * Guardar los datos en la base de datos de BIENES INMUEBLES
        if ($bienes[0][1] !== "" && $bienes[0][1] !== null) {
            foreach ($bienes as $bien) {
                bienes_inmuebles_mensuales::create([
                    'nombre' => $bien[0],
                    'cantidad' => $bien[1],
                    'valor_unitario' => $bien[2],
                    'porcentaje_depreciacion' => $bien[4],
                    'anio_uno' => $bien[6],
                    'anio_dos' => $bien[7],
                    'anio_tres' => $bien[8],
                    'anio_cuatro' => $bien[9],
                    'anio_cinco' => $bien[10],
                    'estudio_id' => $estudio->id
                ]);
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
