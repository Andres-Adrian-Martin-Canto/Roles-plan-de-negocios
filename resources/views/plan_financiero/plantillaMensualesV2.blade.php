<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $titulo }}</title>
    @vite(['resources/css/estilos.css', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/menuIzquierdo', 'resources/js/funcionalidadMensualV2'])
</head>

<body class="p-0 m-0">
    {{-- Incluye el menu de navegacion --}}
    @include('layouts.navigation')
    {{-- Cabeza de la pagina --}}
    <div class="flex items-center flex-col text-black my-2 sm:my-4">
        <h1 class="text-4xl antialiased font-sans ">Plan Financiero</h1>
        <h2>{{ $titulo }}</h2>
    </div>

    {{-- Las dos partes --}}
    <div class="flex justify-center items-start 2xl:px-10 flex-wrap gap-10 w-full h-full ">
        {{-- Es el menu del lador izquierdo --}}
        <div class="relative rounded-lg border-none card w-1/6 h-full bg-white 2xl:pl-10 p-6 mt-9 dark:bg-gray-800">
            @include('plan_financiero.menuIzquierdo')
        </div>
        {{-- Lado derecho --}}
        <div class="card w-3/4 mt-3">
            <h2 class="text-center text-2xl dark:text-white my-5">{{ $titulo }}</h2>
            <hr class="my-2 h-0.5 border-t-0 w-full bg-neutral-100 dark:bg-white m-0 p-0" />
            <div class="px-2 pb-2 mx-2 mb-2 bg-white">
                <h2 class="text-center py-4  2xl:text-2xl text-lg font-normal">Ingresa los {{ $titulo }}</h2>
                <table class="w-full table-auto" dato='{{ $plan_de_negocio->id }}'>
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border w-24">{{ $columnaPrincipal }}</th>
                            <th class="border w-16">{{ $columnaSecundaria }}</th>
                            <th class="border w-16">{{ $columnaTercera }}</th>
                            <th class="border w-16">{{ $columnaCuarta }}</th>
                            <th class="border w-10">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)
                            <tr>
                                @php
                                    $key = array_keys($dato);
                                @endphp
                                <td class="border px-4 py-2"> <input type="text"
                                        class="w-full border rounded-sm px-2 py-1 text-left"
                                        value="{{ $dato[$key[2]] }}">
                                </td>
                                @for ($x = 3; $x < 5; $x++)
                                    <td class="border px-4 py-2"> <input type="text"
                                            class="w-full border rounded-sm px-2 py-1 text-right"
                                            value="{{ $dato[$key[$x]] }}">
                                    </td>
                                @endfor
                                <td class="border px-4 py-2"> <input type="text"
                                        class="w-full border rounded-sm px-2 py-1 text-right" disabled
                                        value="{{ sprintf('%.2f', $dato[$key[3]] * $dato[$key[4]]) }}">
                                </td>
                                <td class="border"> <button
                                        class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="border px-4 py-2"><input class="w-full border rounded-sm px-2 py-1" type=text>
                            </td>
                            <td class="border px-4 py-2"><input class="w-full border text-right rounded-sm px-2 py-1"
                                    type="text"></td>
                            <td class="border px-4 py-2"><input class="w-full border text-right rounded-sm px-2 py-1"
                                    type="text"></td>
                            <td class="border px-4 py-2"><input class="w-full border text-right rounded-sm px-2 py-1"
                                    type="text" disabled></td>
                        </tr>
                    </tbody>
                    <tfoot class="">
                        <tr>
                            <td id="totaldeTotales" colspan="5"
                                class="text-right pr-2 font-bold dark:bg-gray-800  text-white">
                                Total {{ $titulo }}: $0.00
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            {{-- TODO: Boton para guardar --}}
            <div class="flex justify-center py-3">
                {{-- TODO: Inserto la urlDinamica --}}
                <button id="miBoton" urlDinamica={{ $url }} informacion={{ count($datos_anuales) }}
                    disabled class="w-1/4  bg-green-800 text-gray-400 font-bold py-1  rounded">
                    Guardar cambios
                </button>
            </div>
        </div>
    </div>
</body>

</html>
