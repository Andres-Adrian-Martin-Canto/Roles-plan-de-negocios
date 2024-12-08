<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $titulo }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/flujoEfectivoAnualCincoAnios.js'])
</head>

<body>
    {{-- barra de navegacion header --}}
    @include('layouts.navigation')
    {{-- Boton de regreso --}}
    <div>
        <button class="bg-slate-300 text-black hover:bg-green-400 m-2 rounded-sm">
            <a href="{{ route('plan_de_negocio.gastoPreoperativo.index', $plan_de_negocio) }}" class="flex gap-3 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                <span class="">Regresar</span>
            </a>
        </button>
    </div>
    {{-- Informacion de la vista --}}
    <div class="mb-5">
        <h1 class="text-center text-4xl font-bold font-sans ">Plan financiero</h1>
        <h2 class="text-center">{{ $titulo }}</h2>
    </div>
    {{-- Contenedor  --}}
    <div class="mx-4 card">
        {{-- Texto informativo --}}
        <h2 class="text-center text-2xl text-white py-4">{{ $titulo }}</h2>
        {{-- Particion del texto informativo y la tabla --}}
        <hr class="my-2 h-0.5  border-t-0 w-full bg-neutral-100 dark:bg-white m-0 p-0" />
        {{-- Contenedor de la tabla --}}
        <div class=" px-2 py-3 mx-2  bg-white">
            <table class="w-full px-10 table-auto" id="miTabla" dato='{{ $plan_de_negocio->id }}'>
                {{-- TODO: Parte costos fijos --}}
                <thead>
                    <tr>
                        <td colspan="13" class="text-center bg-fuchsia-300 text-black">
                            Gastos preoperativos
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Cabecera informativa --}}
                <thead>
                    <tr>
                        <th class="border text-right pr-2 border-gray-500 dark:bg-gray-800  text-white" width="15%"
                            colspan="2">año 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 5</th>

                    </tr>
                </thead>
                {{-- TODO: Gastos preoperativos --}}
                <tbody id="gastos_preoperativos">
                    {{-- TODO: Si existen los gastos preoperativos anuales --}}
                    @if (count($dataGastosPreoperativosCincoAnios) > 0)
                        {{-- Se agregan los ingresos de cinco años --}}
                        @foreach ($dataGastosPreoperativosCincoAnios as $idPertenece => $items)
                            @foreach ($items as $nombrePertenece => $valores)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $idPertenece }}">{{ $nombrePertenece }}</td>
                                    @foreach ($valores as $item)
                                        <td class="border" width="7.5%" id_actual={{ $item[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $item[1] }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        {{-- TODO: Si no existe los gastos preoperativos anuales entonces ingresara los mensuales --}}
                    @else
                        {{-- For para recorrer item por item --}}
                        @foreach ($dataGastosPreoperativoAnuales as $id => $item)
                            @foreach ($item as $nombre => $monto)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $id }}">{{ $nombre }}</td>
                                    @for ($i = 0; $i < 5; $i++)
                                        <td class="border" width="7.5%" id_actual="0">
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $monto }}">
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
                {{-- TODO: Utilidades Gastos Preoperativos --}}
                <thead>
                    <tr id="Total_Gastos_Preoperativos">
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"
                            width="15%">
                            Total Gastos Preoperativos: </th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                    </tr>
                </thead>
                {{-- TODO: Parte de Gastos --}}
                <thead>
                    <tr>
                        <td colspan="13" class="text-center bg-orange-300 text-black">
                            Gastos
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Cabecera informativa --}}
                <thead>
                    <tr>
                        <th class="border text-right pr-2 border-gray-500 dark:bg-gray-800  text-white" width="15%"
                            colspan="2">año 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 5</th>
                    </tr>
                </thead>
                {{-- TODO: Body de gastos --}}
                <tbody id="gastos">
                    @if (count($dataGastosCincoAnios) > 0)
                        {{-- Se agregan los ingresos de cinco años --}}
                        @foreach ($dataGastosCincoAnios as $idPertenece => $items)
                            @foreach ($items as $nombrePertenece => $valores)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $idPertenece }}">{{ $nombrePertenece }}</td>
                                    @foreach ($valores as $item)
                                        <td class="border" width="7.5%" id_actual={{ $item[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $item[1] }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        {{-- TODO: Si no existe los gastos preoperativos anuales entonces ingresara los mensuales --}}
                    @else
                        {{-- For para recorrer item por item --}}
                        @foreach ($dataGastosAnuales as $id => $item)
                            @foreach ($item as $nombre => $monto)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $id }}">{{ $nombre }}</td>
                                    @for ($i = 0; $i < 5; $i++)
                                        <td class="border" width="7.5%" id_actual="0">
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $monto }}">
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
                {{-- TODO: Utilidades de los GASTOS por año --}}
                <thead>
                    <tr id="Total_gastos">
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"
                            width="15%">
                            Total gastos: </th>
                        <th class="border text-xs text-right  border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right  border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right  border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right  border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right  border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                    </tr>
                </thead>
                {{-- TODO: Parte de Gastos de articulos de venta --}}
                <thead>
                    <tr>
                        <td colspan="13" class="text-center bg-amber-300 text-black">
                            Gastos de artículos de venta
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Cabecera informativa --}}
                <thead>
                    <tr>
                        <th class="border text-right pr-2 border-gray-500 dark:bg-gray-800  text-white" width="15%"
                            colspan="2">año 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 5</th>
                    </tr>
                </thead>
                {{-- TODO: Cuerpo de Gastos de articulos de venta --}}
                <tbody id="Gastos_articulos_venta">
                    @if (count($dataGastos_Articulos_Venta_CincoAnios) > 0)
                        {{-- Se agregan los ingresos de cinco años --}}
                        @foreach ($dataGastos_Articulos_Venta_CincoAnios as $idPertenece => $items)
                            @foreach ($items as $nombrePertenece => $valores)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $idPertenece }}">{{ $nombrePertenece }}</td>
                                    @foreach ($valores as $item)
                                        <td class="border" width="7.5%" id_actual={{ $item[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $item[1] }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        {{-- TODO: Si no existe los gastos preoperativos anuales entonces ingresara los mensuales --}}
                    @else
                        {{-- For para recorrer item por item --}}
                        @foreach ($dataGastos_Articulos_Venta_Anuales as $id => $item)
                            @foreach ($item as $nombre => $monto)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $id }}">{{ $nombre }}</td>
                                    @for ($i = 0; $i < 5; $i++)
                                        <td class="border" width="7.5%" id_actual="0">
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $monto }}">
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
                {{-- TODO: Utilidades de Gastos de articulos de venta --}}
                <thead>
                    <tr id="Total_Gastos_articulos_venta">
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"
                            width="15%">
                            Total Gastos de artículos de venta: </th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                    </tr>
                </thead>
                {{-- TODO: Parte de Ingresos --}}
                <thead>
                    <tr>
                        <td colspan="13" class="text-center bg-lime-300 text-black">
                            Ingresos
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Cabecera informativa --}}
                <thead>
                    <tr>
                        <th class="border text-right pr-2 border-gray-500 dark:bg-gray-800  text-white" width="15%"
                            colspan="2">año 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">año 5</th>
                    </tr>
                </thead>
                {{-- TODO: Cuerpo de Ingresos --}}
                <tbody id="ingresos">
                    @if (count($ingresosCincoAnios) > 0)
                        {{-- Se agregan los ingresos de cinco años --}}
                        @foreach ($ingresosCincoAnios as $idPertenece => $items)
                            @foreach ($items as $nombrePertenece => $valores)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $idPertenece }}">{{ $nombrePertenece }}</td>
                                    @foreach ($valores as $item)
                                        <td class="border" width="7.5%" id_actual={{ $item[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $item[1] }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        {{-- TODO: Si no existe los gastos preoperativos anuales entonces ingresara los mensuales --}}
                    @else
                        {{-- For para recorrer item por item --}}
                        @foreach ($ingresosAnuales as $id => $item)
                            @foreach ($item as $nombre => $monto)
                                <tr>
                                    <td class="border" width="15%" id_pertenece="{{ $id }}">{{ $nombre }}</td>
                                    @for ($i = 0; $i < 5; $i++)
                                        <td class="border" width="7.5%" id_actual="0">
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $monto }}">
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
                {{-- TODO: Utilidades de Gastos de articulos de venta --}}
                <thead>
                    <tr id="Total_ingresos">
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"
                            width="15%">
                            Total ingresos:</th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-gray-400  text-black"
                            width="7%"></th>
                    </tr>
                </thead>
                {{-- TODO: Utilidades totales --}}
                <thead>
                    <tr id="utilidades">
                        <th class="border text-center text-xs border-gray-500 dark:bg-red-300  text-black"
                            width="15%">
                            Total utilidades: </th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-red-300  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-red-300  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-red-300  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-red-300  text-black"
                            width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 dark:bg-red-300  text-black"
                            width="7%"></th>
                    </tr>
                </thead>
            </table>
        </div>
        {{-- TODO: Boton para guardar --}}
        <div class="flex justify-center py-3">
            @if ($botonActivado)
                {{-- TODO: Inserto la urlDinamica --}}
                <button id="miBoton" urlDinamica={{ $ruta }}
                    class="w-1/4  bg-green-500 text-white font-bold py-1  rounded">
                    Guardar cambios
                </button>
            @else
                {{-- TODO: Inserto la urlDinamica --}}
                <button id="miBoton" urlDinamica={{ $ruta }}  disabled
                    class="w-1/4  bg-green-800 text-gray-400 font-bold py-1  rounded">
                    Guardar cambios
                </button>
            @endif
        </div>
    </div>
</body>

</html>
