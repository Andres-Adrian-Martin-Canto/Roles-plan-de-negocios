<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/inversionInicial.js'])
    <title>Inversion inicial</title>
</head>

<body class="m-0 p-0">
    {{-- Footer  --}}
    @include('layouts.navigation')
    {{-- Cabeza de la pagina --}}
    <div class="flex items-center flex-col text-black my-2 sm:my-4">
        <h1 class="text-4xl antialiased font-sans ">Plan Financiero</h1>
        <h2>Inversion inicial</h2>
    </div>

    <div class="mx-4 card">
        {{-- Texto informativo --}}
        <h2 class="text-center text-2xl text-white py-4"></h2>
        {{-- Particion del texto informativo y la tabla --}}
        <hr class="my-2 h-0.5  border-t-0 w-full bg-neutral-100 dark:bg-white m-0 p-0" />
        {{-- Contenedor de la tabla --}}
        <div class=" px-2 py-3 mx-2 bg-white overflow-x-auto">
            <table class="w-full px-10 table-auto" id="miTabla">
                {{-- TODO: Cabecera informativa --}}
                <thead>
                    <tr class="bg-gray-300 ">
                        <th class="border text-xs p-3 text-black">DESCRIPCIÓN DEL BIEN MUEBLE O INMUEBLE</th>
                        <th class="border text-xs p-3 text-black">CANTIDAD DE BIENES</th>
                        <th class="border text-xs p-3 text-black">VALOR UNITARIO</th>
                        <th class="border text-xs sm:px-5 2xl:p-3 text-black ">TOTAL POR TIPO DE BIEN</th>
                        <th class="border text-xs p-3 text-black">% DE DEPRECIACIÓN POR CADA BIEN</th>
                        <th class="border text-xs p-3 text-black">DEPRECIACIÓN MENSUAL</th>
                        <th class="border text-xs p-3 text-black">DEPRECIACIÓN ANUAL AÑO 1</th>
                        <th class="border text-xs p-3 text-black">DEPRECIACIÓN ANUAL AÑO 2</th>
                        <th class="border text-xs p-3 text-black">DEPRECIACIÓN ANUAL AÑO 3</th>
                        <th class="border text-xs p-3 text-black">DEPRECIACIÓN ANUAL AÑO 4</th>
                        <th class="border text-xs p-3 text-black">DEPRECIACIÓN ANUAL AÑO 5</th>
                        <th class="border text-xs p-3 text-black">DEPRECIACIÓN TOTAL 5 AÑOS</th>
                        <th class="border text-xs p-3 text-black">ACCIONES</th>
                    </tr>
                </thead>
                {{-- TODO: Parte Mobiliario --}}
                <thead>
                    <tr>
                        <td colspan="13" class="text-xs font-bold  text-center bg-fuchsia-300 text-black">
                            Mobiliario
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Body de la parte Mobiliaria --}}
                <tbody id="mobiliario">
                    {{-- @foreach ( as )

                    @endforeach --}}
                    <tr>
                        <td class="border">
                            <input class="w-full border rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 " type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 " type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                    </tr>
                </tbody>
                {{-- TODO: Apartado de maquinaria --}}
                <thead>
                    <tr>
                        <td colspan="13" class="text-xs font-bold text-center bg-green-300 text-black">
                            Maquinaria
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Body de la parte maquinaria --}}
                <tbody id="maquinaria">
                    <tr>
                        <td class="border">
                            <input class="w-full border rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                    </tr>
                </tbody>
                {{-- TODO: Apartado de Vehiculos --}}
                <thead>
                    <tr>
                        <td colspan="13" class="text-xs font-bold text-center bg-red-300 text-black">
                            Vehiculos
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Body de la parte Vehiculos --}}
                <tbody id="vehiculos">
                    <tr>
                        <td class="border">
                            <input class="w-full border rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                    </tr>
                </tbody>
                {{-- TODO: Apartado BIENES INMUEBLES --}}
                <thead>
                    <tr>
                        <td colspan="13" class="text-xs font-bold text-center bg-orange-300 text-black">
                            BIENES INMUEBLES
                        </td>
                    </tr>
                </thead>
                {{-- TODO: Body de la parte BIENES INMUEBLES --}}
                <tbody>
                    <tr>
                        <td class="border">
                            <input class="w-full border rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1" type="text">
                        </td>
                        <td class="border">
                            <input class="w-full border text-right rounded-sm px-2 py-1 bg-gray-300" type="text"
                                disabled>
                        </td>
                    </tr>
                </tbody>
                {{-- TODO: Totales Mobiliario --}}
                <thead>
                    <tr id="Total-mobiliario" class="bg-yellow-100">
                        <th class="border text-center text-xs border-gray-500   text-black" width="27%"
                            colspan="3">
                            Total Mobiliario:
                        </th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-center border-gray-500   text-black" width="7%">Depreciacion total:</th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                    </tr>
                </thead>
                {{-- TODO: Totales Maquinaria --}}
                <thead>
                    <tr id="totales-maquinaria" class="bg-yellow-100">
                        <th class="border text-center text-xs border-gray-500   text-black" width="27%" colspan="3">
                            Total Maquinaria: </th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-center border-gray-500   text-black" width="7%">Depreciacion total:</th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                    </tr>
                </thead>
                {{-- TODO: Totales Vehiculos --}}
                <thead>
                    <tr id="total-vehiculos" class="bg-yellow-100">
                        <th class="border text-center text-xs border-gray-500   text-black" width="27%" colspan="3">
                            Total Vehiculos:
                        </th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-center border-gray-500   text-black" width="7%">Depreciacion total:</th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                    </tr>
                </thead>
                {{-- TODO: Totales Bienes inmuebles --}}
                <thead>
                    <tr id="total-bienes-inmuebles" class="bg-yellow-100">
                        <th class="border text-center text-xs border-gray-500   text-black" width="27%" colspan="3">
                            Total Bienes inmuebles: </th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-center border-gray-500   text-black" width="7%">Depreciacion total:</th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500   text-black" width="7%"></th>
                    </tr>
                </thead>
                <thead>
                    <tr id="total-bienes-muebles-e-inmuebles" class="bg-yellow-100">
                        <th class="border text-center text-xs border-gray-500 text-black" width="27%" colspan="3">
                            Total Bienes Muebles e Inmuebles: </th>
                        <th class="border text-xs text-right border-gray-500 text-black" width="7%"></th>
                        <th class="border text-xs text-center border-gray-500 text-black" width="7%">Depreciacion total:</th>
                        <th class="border text-xs text-right border-gray-500 text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 text-black" width="7%"></th>
                        <th class="border text-xs text-right border-gray-500 text-black" width="7%"></th>
                    </tr>
                </thead>
            </table>
        </div>
        {{-- TODO: Boton para guardar --}}
        <div class="flex justify-center py-3">

        </div>
    </div>

</body>

</html>
