<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $titulo }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                            colspan="2">Mes 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 5</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 6</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 7</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 8</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 9</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 10</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 11</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 12</th>
                    </tr>
                </thead>
                {{-- TODO: Gastos preoperativos --}}
                <tbody>
                    {{-- TODO: Si existen los gastos preoperativos anuales --}}
                    @if (count($dataGastosPreoperativoAnuales) > 0)
                        @foreach ($dataGastosPreoperativoAnuales as $id_pertenece => $secondArray)
                            <tr>
                                @foreach ($secondArray as $nombrePertenece => $meses)
                                    <td class="border" width="15%" id_pertenece="{{ $id_pertenece }}">
                                        {{ $nombrePertenece }}
                                    </td>
                                    @foreach ($meses as $value)
                                        <td class="border" width="7%" id_actual={{ $value[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $value[1] }}">
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                        {{-- TODO: Si no existe los gastos preoperativos anuales entonces ingresara los mensuales --}}
                    @else
                        {{-- For para recorrer item por item --}}
                        @foreach ($dataGastosPreoperativosMensuales as $item)
                            <tr>
                                <td class="border" width="15%" id_pertenece="{{ $item[0] }}">
                                    {{ $item[1] }}
                                </td>
                                {{-- For para repetir el valor --}}
                                @for ($i = 0; $i < 12; $i++)
                                    <td class="border" id_actual="0" width="7%">
                                        <input type="text" class="w-full border rounded-sm text-xs px-0 text-right"
                                            value="{{ $item[2] }}">
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                {{-- TODO: Utilidades Gastos Preoperativos --}}
                <thead>
                    <tr id="costosFijos">
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
                            colspan="2">Mes 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 5</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 6</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 7</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 8</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 9</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 10</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 11</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 12</th>
                    </tr>
                </thead>
                {{-- TODO: Body de gastos --}}
                <tbody>
                    {{-- Si existen los anuales entrara aqui --}}
                    @if (count($dataGastosAnuales) > 0)
                        @foreach ($dataGastosAnuales as $id_pertenece => $secondArray)
                            <tr>
                                @foreach ($secondArray as $nombrePertenece => $meses)
                                    <td class="border" width="15%" id_pertenece="{{ $id_pertenece }}">
                                        {{ $nombrePertenece }}
                                    </td>
                                    @foreach ($meses as $value)
                                        <td class="border" width="7%" id_actual={{ $value[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $value[1] }}">
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    @else
                        {{-- De lo contrario entraran en los mensuales --}}
                        {{-- For para recorrer item por item --}}
                        @foreach ($dataGastosMensuales as $item)
                            <tr>
                                <td class="border" width="15%" id_pertenece="{{ $item[0] }}">
                                    {{ $item[1] }}
                                </td>
                                {{-- For para repetir el valor --}}
                                @for ($i = 0; $i < 12; $i++)
                                    <td class="border" id_actual="0" width="7%">
                                        <input type="text" class="w-full border rounded-sm text-xs px-0 text-right"
                                            value="{{ $item[2] }}">
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                {{-- TODO: Utilidades de los GASTOS por año --}}
                <thead>
                    <tr id="costosVariable">
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
                            Gastos de articulos de venta
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Cabecera informativa --}}
                <thead>
                    <tr>
                        <th class="border text-right pr-2 border-gray-500 dark:bg-gray-800  text-white" width="15%"
                            colspan="2">Mes 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 5</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 6</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 7</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 8</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 9</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 10</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 11</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 12</th>
                    </tr>
                </thead>
                {{-- TODO: Cuerpo de Gastos de articulos de venta --}}
                <tbody>
                    {{-- Si existen los anuales entrara aqui --}}
                    @if (count($dataGastos_Articulos_Venta_Anuales) > 0)
                        @foreach ($dataGastos_Articulos_Venta_Anuales as $id_pertenece => $secondArray)
                            <tr>
                                @foreach ($secondArray as $nombrePertenece => $meses)
                                    <td class="border" width="15%" id_pertenece="{{ $id_pertenece }}">
                                        {{ $nombrePertenece }}
                                    </td>
                                    @foreach ($meses as $value)
                                        <td class="border" width="7%" id_actual={{ $value[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $value[1] }}">
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    @else
                        {{-- De lo contrario entraran en los mensuales --}}
                        {{-- For para recorrer item por item --}}
                        @foreach ($dataGastos_Articulos_Venta_Mensuales as $item)
                            <tr>
                                <td class="border" width="15%" id_pertenece="{{ $item[0] }}">
                                    {{ $item[1] }}
                                </td>
                                {{-- For para repetir el valor --}}
                                @for ($i = 0; $i < 12; $i++)
                                    <td class="border" id_actual="0" width="7%">
                                        <input type="text" class="w-full border rounded-sm text-xs px-0 text-right"
                                            value="{{ $item[2] }}">
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                {{-- TODO: Utilidades de Gastos de articulos de venta --}}
                <thead>
                    <tr id="ingresos">
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"
                            width="15%">
                            Total Gastos de articulos de venta: </th>
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
                            colspan="2">Mes 1</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 2</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 3</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 4</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 5</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 6</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 7</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 8</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 9</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 10</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 11</th>
                        <th class="border border-gray-500 dark:bg-gray-800  text-white" width="7%">Mes 12</th>
                    </tr>
                </thead>
                {{-- TODO: Cuerpo de Ingresos --}}
                <tbody>
                    {{-- Si existen los anuales entrara aqui --}}
                    @if (count($ingresosAnuales) > 0)
                        @foreach ($ingresosAnuales as $id_pertenece => $secondArray)
                            <tr>
                                @foreach ($secondArray as $nombrePertenece => $meses)
                                    <td class="border" width="15%" id_pertenece="{{ $id_pertenece }}">
                                        {{ $nombrePertenece }}
                                    </td>
                                    @foreach ($meses as $value)
                                        <td class="border" width="7%" id_actual={{ $value[0] }}>
                                            <input type="text"
                                                class="w-full border rounded-sm text-xs px-0 text-right"
                                                value="{{ $value[1] }}">
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    @else
                        {{-- De lo contrario entraran en los mensuales --}}
                        {{-- For para recorrer item por item --}}
                        @foreach ($ingresosMensuales as $item)
                            <tr>
                                <td class="border" width="15%" id_pertenece="{{ $item[0] }}">
                                    {{ $item[1] }}
                                </td>
                                {{-- For para repetir el valor --}}
                                @for ($i = 0; $i < 12; $i++)
                                    <td class="border" id_actual="0" width="7%">
                                        <input type="text" class="w-full border rounded-sm text-xs px-0 text-right"
                                            value="{{ $item[2] }}">
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                {{-- TODO: Utilidades de Gastos de articulos de venta --}}
                <thead>
                    <tr id="ingresos">
                        <th class="border text-center text-xs border-gray-500 dark:bg-gray-400  text-black"
                            width="15%">
                            Total Gastos de articulos de venta: </th>
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
