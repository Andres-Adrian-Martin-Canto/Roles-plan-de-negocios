<?php

namespace App\Http\Controllers;

use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;

class totalInversionInicial extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        $estudio = $plan_de_negocio->estudioFinancieroV2;
        $titulo = "Total de Inversión Inicial";
        // ! Enviar la ruta.
        $url = "totalInversionInicial";
        // * Variables para sacar el total de cada apartado
        $totalMobiliario = 0;
        $totalMaquinaria = 0;
        $totalVehiculos = 0;
        $totalBienesInmuebles = 0;
        // * Variables para sacar el total de gastos preoperativos
        $totalGastosPreoperativos = 0;

        // * Sacar el total de mobiliario
        $mobiliario = $estudio->mobiliario_mensual()->select('cantidad', 'valor_unitario')->get();
        foreach ($mobiliario as $mobil) {
            $totalMobiliario += $mobil->cantidad * $mobil->valor_unitario;
        }

        // * Sacar el total de maquinaria
        $maquinaria = $estudio->maquinarias_mensuales()->select('cantidad', 'valor_unitario')->get();
        foreach ($maquinaria as $maq) {
            $totalMaquinaria += $maq->cantidad * $maq->valor_unitario;
        }

        // * Sacar el total de vehiculos
        $vehiculos = $estudio->vehiculos_mensuales()->select('cantidad', 'valor_unitario')->get();
        foreach ($vehiculos as $vehiculo) {
            $totalVehiculos += $vehiculo->cantidad * $vehiculo->valor_unitario;
        }

        // * Sacar el total de bienes inmuebles
        $bienesInmuebles = $estudio->bienes_inmuebles_mensuales()->select('cantidad', 'valor_unitario')->get();
        foreach ($bienesInmuebles as $bienInmueble) {
            $totalBienesInmuebles += $bienInmueble->cantidad * $bienInmueble->valor_unitario;
        }

        // * Sacar el total de gastos preoperativos
        $gastosPreoperativos = $estudio->gastoPreoperativo()->select('costo_unitario')->get();
        foreach ($gastosPreoperativos as $gastoPreoperativo) {
            $totalGastosPreoperativos += $gastoPreoperativo->cantidad * $gastoPreoperativo->valor_unitario;
        }
        // * Enviarle los datos de capital de trabajo y prestamo.
        $capitalTrabajo = $estudio->total_capital_de_trabajo;
        $prestamo = $estudio->total_prestamo;


        return view('plan_financiero.totalInversionInicial', compact('plan_de_negocio','titulo', 'url', 'totalMobiliario', 'totalMaquinaria', 'totalVehiculos', 'totalBienesInmuebles', 'totalGastosPreoperativos', 'capitalTrabajo', 'prestamo'));
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
    public function store(Request $request)
    {
        //
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
