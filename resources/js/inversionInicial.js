document.addEventListener("DOMContentLoaded", function () {
    var matrizMobiliario = [];
    var matrizMaquinaria = [];
    var matrizVehiculos = [];
    var matrizBienesInmuebles = [];
    // Obtenemos los tbodys de la tabla
    let tbodies = document.querySelectorAll('#miTabla tbody');
    // Le asignamos al body mobiliario los valores.
    obtenerDatos(tbodies[0], matrizMobiliario, 'Total-mobiliario');
    obtenerDatos(tbodies[1], matrizMaquinaria, 'totales-maquinaria');
    obtenerDatos(tbodies[2], matrizVehiculos, 'total-vehiculos');
    obtenerDatos(tbodies[3], matrizBienesInmuebles, 'total-bienes-inmuebles');
    // * Llamar funcion para calcular el total de bienes.
    calculaTotalBienesUtilidades('Total-mobiliario', matrizMobiliario);
    calculaTotalBienesUtilidades('totales-maquinaria', matrizMaquinaria);
    calculaTotalBienesUtilidades('total-vehiculos', matrizVehiculos);
    calculaTotalBienesUtilidades('total-bienes-inmuebles', matrizBienesInmuebles);
    // * Llamar funcion para calcular el total de depreciacion mensual.
    calcularDepreciacionTotalMensual('Total-mobiliario', matrizMobiliario);
    calcularDepreciacionTotalMensual('totales-maquinaria', matrizMaquinaria);
    calcularDepreciacionTotalMensual('total-vehiculos', matrizVehiculos);
    calcularDepreciacionTotalMensual('total-bienes-inmuebles', matrizBienesInmuebles);
    // * Llamar funcion para calcular el total de depreciacion de 5 anios.
    calcularPorAnioDepreciacion('Total-mobiliario', matrizMobiliario, 6);
    calcularPorAnioDepreciacion('Total-mobiliario', matrizMobiliario, 7);
    calcularPorAnioDepreciacion('Total-mobiliario', matrizMobiliario, 8);
    calcularPorAnioDepreciacion('Total-mobiliario', matrizMobiliario, 9);
    calcularPorAnioDepreciacion('Total-mobiliario', matrizMobiliario, 10);
    // * Llamar funcion para calcular el total de depreciacion de 5 anios.
    calcularPorAnioDepreciacion('totales-maquinaria', matrizMaquinaria, 6);
    calcularPorAnioDepreciacion('totales-maquinaria', matrizMaquinaria, 7);
    calcularPorAnioDepreciacion('totales-maquinaria', matrizMaquinaria, 8);
    calcularPorAnioDepreciacion('totales-maquinaria', matrizMaquinaria, 9);
    calcularPorAnioDepreciacion('totales-maquinaria', matrizMaquinaria, 10);
    // * Llamar funcion para calcular el total de depreciacion de 5 anios.
    calcularPorAnioDepreciacion('total-vehiculos', matrizVehiculos, 6);
    calcularPorAnioDepreciacion('total-vehiculos', matrizVehiculos, 7);
    calcularPorAnioDepreciacion('total-vehiculos', matrizVehiculos, 8);
    calcularPorAnioDepreciacion('total-vehiculos', matrizVehiculos, 9);
    calcularPorAnioDepreciacion('total-vehiculos', matrizVehiculos, 10);
    // * Llamar funcion para calcular el total de depreciacion de 5 anios.
    calcularPorAnioDepreciacion('total-bienes-inmuebles', matrizBienesInmuebles, 6);
    calcularPorAnioDepreciacion('total-bienes-inmuebles', matrizBienesInmuebles, 7);
    calcularPorAnioDepreciacion('total-bienes-inmuebles', matrizBienesInmuebles, 8);
    calcularPorAnioDepreciacion('total-bienes-inmuebles', matrizBienesInmuebles, 9);
    calcularPorAnioDepreciacion('total-bienes-inmuebles', matrizBienesInmuebles, 10);
    // * Llamar funcion para calcular el total de bienes.
    calcularLosFooterTotales(1);
    calcularLosFooterTotales(2);
    calcularLosFooterTotales(6);
    calcularLosFooterTotales(7);
    calcularLosFooterTotales(8);
    calcularLosFooterTotales(9);
    calcularLosFooterTotales(10);



    function calcularDepreciacionTotalCincoAniosPorCadaAnio(tipo, matriz, posicionColumna) {
        let th = document.querySelectorAll(`#${tipo} th`);
        // * variable que me sirve para calcular el total de bienes.
        let total = 0;
        // poner el primer for para recorrer las filas
        for (let i = 0; i < matriz.length; i++) {
            // variable para obtener el total de la columna
            total += isNaN(parseFloat(matriz[i][posicionColumna])) ? 0 : parseFloat(matriz[i][posicionColumna]);
        }
        // * Se asigna el valor al th de la tabla.
        th[posicionColumna - 2].textContent = total.toFixed(2);
    }




    /**
     *  TODO: Funcion para obtener los datos de los inputs de la tabla.
     * @param {*} tbody
     * @param {*} matriz
     */
    function obtenerDatos(tbody, matriz, tipo) {
        // Obtenemos las filas del body correspondiente
        let filas = tbody.querySelectorAll('tr');
        // Recorremos las filas
        filas.forEach(function (fila) {
            // Obtenemos las celdas de la fila
            let inputs = fila.querySelectorAll("input");
            // arreglo que guardara los valores de los inputs y luego lo agregara a matriz correspondiente.
            let arrayValores = [];
            // Recorremos los inputs
            inputs.forEach(function (input) {
                // Evento para el input
                eventInput(input, matriz, inputs, tipo);
                // Guardamos los valores de los inputs
                arrayValores.push(input.value);
            });
            matriz.push(arrayValores);
        });
    } // Fin de la funcion obtenerDatos


    /**
     *  TODO: Funcion para asignarle un evento a los inputs.
     * @param {*} input
     * @param {*} filaIndex
     * @param {*} matriz
     * @param {*} inputs
     * @param {*} tipo
     */
    function eventInput(input, matriz, inputs, tipo) {

        // Evento para el input
        input.addEventListener("blur", function () {
            // Creación de expresión regular.
            const regex = /^[-+]?\d*\.?\d+$/;
            // * Obtener el padre
            let tdPadre = input.parentElement;
            // * Obtengo la posicion de la columna.
            let posicionColumna = tdPadre.cellIndex;
            // Encuentra el elemento 'tr' padre del 'tdPadre'
            let filaPadre = tdPadre.closest('tr');
            // Obtener el índice de la fila
            let filaIndex = Array.from(filaPadre.parentElement.children).indexOf(filaPadre);

            // * Condicion para saber si la columna es igual a cero entonces se aplicaran funciones especificas.
            if (posicionColumna === 0) { // Evento para el input de la columna 0 (nombre)
                if (input.value.trim() !== matriz[filaIndex][posicionColumna]) {
                    // Borrar los espacios y asignarselo al input
                    input.value = input.value.trim();
                    // * Se actualiza el valor del diccionario.
                    matriz[filaIndex][posicionColumna] = input.value;
                    validacionCrearFila(matriz, filaIndex, tdPadre.parentElement, tipo);
                }
            } else { // Evento para los otros inputs
                if (input.value.trim() && regex.test(input.value)) {
                    if (input.value.trim() !== matriz[filaIndex][posicionColumna]) {
                        // Borrar los espacios y asignarselo al input
                        input.value = input.value.trim();
                        // * Se actualiza el valor del diccionario.
                        matriz[filaIndex][posicionColumna] = input.value;
                        // Crear condicion de que dice si la columna es entre y 1 y 2 entonces se hara el resultado.
                        if (posicionColumna >= 1 && posicionColumna <= 2) {
                            calcularTotalBienes(matriz, inputs, filaIndex, tipo);
                            calcularLosFooterTotales(posicionColumna);
                            // * Llamar funcion para calcular el otro apartado.
                        } else if (posicionColumna === 4) { // Cuando entre al porcentaje de depreciacion hara lo siguiente
                            calcularDepreciacionMensual(matriz, filaIndex, inputs, tipo);
                            calcularLosFooterTotales(posicionColumna);
                        } else { // calcular la suma total de los 5 anios.
                            // * Llamar funcion para calcular el total depreciacion de 5 anios.
                            calcularDepreciacionCincoAnios(matriz, inputs, filaIndex);
                            calcularPorAnioDepreciacion(tipo, matriz, posicionColumna);
                            calcularLosFooterTotales(posicionColumna);
                        }
                        // * Llamar funcion para validar si la fila esta completa, creara otra fila.
                        validacionCrearFila(matriz, filaIndex, tdPadre.parentElement, tipo);
                        // Crear condicion que diga si la posicion de la columna es 3 entonces hara lo siguiente, que seria calcular solo el mensual.
                        // console.log(matriz);

                        // !!! Llamar funcion para activar el boton de guardar.
                    }
                } else {
                    // Le asignamos el valor 0
                    input.value = 0;
                    // * Se actualiza el valor del diccionario.
                    matriz[filaIndex][posicionColumna] = 0;
                    // * Crear condicion para saber si la columna es entre 1 y 5 entonces se hara el resultado.
                    if (posicionColumna >= 1 && posicionColumna <= 5) {
                        // * Llamar funcion para calcular el total de bienes.
                        calcularTotalBienes(matriz, inputs, filaIndex, tipo);
                    } else {
                        // * Llamar funcion para calcular el total depreciacion de 5 anios.
                        calcularDepreciacionCincoAnios(matriz, inputs, filaIndex);
                        calcularPorAnioDepreciacion(tipo, matriz, posicionColumna);
                    } // Fin de la condicion
                    calcularLosFooterTotales(posicionColumna);
                    // * Llamar funcion para validar si la fila esta completa, creara otra fila.
                    validacionCrearFila(matriz, filaIndex, tdPadre.parentElement, tipo);
                    // !!! Llamar funcion para activar el boton de guardar.
                    alert("Solo se permiten numeros");
                }
            }// Fin de la condicion
        }); // Fin del evento
    }// Fin de la funcion eventInput


    /**
     *  TODO: Funcion para calcular la depreciacion mensual.
     * @param {*} matriz
     * @param {*} filaIndex
     */
    function calcularDepreciacionMensual(matriz, filaIndex, inputs, tipo) {
        let porcentajeDepreciacion = isNaN(parseFloat(matriz[filaIndex][4])) ? 0 : parseFloat(matriz[filaIndex][4]);
        let total = isNaN(parseFloat(matriz[filaIndex][3])) ? 0 : parseFloat(matriz[filaIndex][3]);
        let mensual = ((total * (porcentajeDepreciacion / 100)) / 12).toFixed(2);
        inputs[5].value = mensual;
        matriz[filaIndex][5] = mensual;
        calcularDepreciacionTotalMensual(tipo, matriz);
    }


    /**
     *  TODO: Funcion para validar si la fila esta completa, creara otra fila.
     * @param {*} matriz
     * @param {*} filaIndex
     * @returns
     */
    function validacionCrearFila(matriz, filaIndex, tdFila, tipo) {
        // If para validar si la fila es igual a la ultima fila de la matriz.
        if (matriz.length === filaIndex + 1) {
            // validar que la fila no tenga '' en todas las columnas
            let ultimaFila = matriz[matriz.length - 1];
            let contador = 0;
            for (let i = 0; i < ultimaFila.length; i++) {
                if (ultimaFila[i] === '') {
                    contador++;
                    return;
                }
            } // Fin del for para ver si tiene espacios en blanco.
            // * Condicion que dice si el contador es igual a 0 entonces se creara una nueva fila.
            if (contador === 0) {
                let arrayVacio = [];
                for (let i = 0; i < ultimaFila.length; i++) {
                    arrayVacio.push('');
                }
                matriz.push(arrayVacio);
                // * Llamar funcion para crear button de eliminar.
                crearBoton(tdFila, matriz, tipo);
                // * Llamar funcion para crear la fila en el html.
                crearFilaHtml(tdFila.parentElement, matriz, tipo);
            }
        }// Fin de la condicion
    }// Fin de la funcion validacionCrearFila


    /**
     *  TODO: Funcion para crear una nueva fila en el html.
     * @param {*} tbody
     * @param {*} matriz
     * @param {*} tipo
     */
    function crearFilaHtml(tbody, matriz, tipo) {
        // Crea una nueva fila
        let nuevaFila = document.createElement('tr');
        // Crea las celdas y añade contenido
        for (let i = 0; i < 12; i++) {
            let nuevaCelda = document.createElement('td');
            let input = document.createElement('input');
            input.type = 'text';
            if (i === 0) {
                input.classList.add('w-full', 'border', 'rounded-sm', 'px-2', 'py-1');
            } else if (i === 3 || i === 5 || i === 11) {
                input.disabled = true;
                input.classList.add('w-full', 'border', 'text-right', 'rounded-sm', 'px-2', 'py-1', 'bg-gray-300');
            } else {
                input.classList.add('w-full', 'border', 'text-right', 'rounded-sm', 'px-2', 'py-1');
            }
            nuevaCelda.appendChild(input);
            nuevaFila.appendChild(nuevaCelda);
        }
        // Añade la nueva fila al tbody
        tbody.appendChild(nuevaFila);
        // * Asignarle los eventos a los inputs.
        nuevaFila.querySelectorAll('input').forEach(function (input) {
            eventInput(input, matriz, nuevaFila.querySelectorAll('input'), tipo);
        });
    }


    /**
     *  TODO: Funcion para crear un boton de eliminar.
     *  @param {*} tdFila
     */
    function crearBoton(tdFila, matriz, tipo) {
        let newTd = document.createElement('td');
        let newButton = document.createElement('button');
        newButton.textContent = 'Eliminar';
        newButton.classList.add(
            "bg-red-500",
            "hover:bg-red-700",
            "text-white",
            "font-bold",
            "py-2",
            "px-4",
            "rounded",
            "w-full"
        );
        // * Llamar funcion para crear evento del boton.
        eventoBotonEliminar(newButton, matriz, tipo);
        newTd.appendChild(newButton);
        tdFila.appendChild(newTd);
    }


    /**
     *  TODO: Evento boton para eliminar la fila.
     * @param {*} newButton
     * @param {*} matriz
     * @param {*} tipo
     */
    function eventoBotonEliminar(newButton, matriz, tipo) {
        newButton.addEventListener('click', function () {
            let row = newButton.closest('tr');
            // Obtener el índice de la fila
            let filaIndex = Array.from(row.parentElement.children).indexOf(row);
            // Eliminar fila de la matriz
            matriz.splice(filaIndex, 1);
            // Eliminar igual de la tabla
            row.remove();
            // TODO: Llamar funcion para calcular el total de bienes.
            calculaTotalBienesUtilidades(tipo, matriz);
            calcularDepreciacionTotalMensual(tipo, matriz);
            for (let j = 6; j < 11; j++) {
                calcularPorAnioDepreciacion(tipo, matriz, j);
            }
            calcularLosFooterTotales(2);
            calcularLosFooterTotales(6);
            calcularLosFooterTotales(7);
            calcularLosFooterTotales(8);
            calcularLosFooterTotales(9);
            calcularLosFooterTotales(10);
        });
    }


    /**
     *  TODO: Funcion para calcular la multiplicacion de UNIDADES por VALOR UNITARIO.
     * @param {*} matriz
     * @param {*} inputs
     * @param {*} filaIndex
     * @param {*} tipo
     */
    function calcularTotalBienes(matriz, inputs, filaIndex, tipo) {
        // * Se obtiene el valor de la columna 1 y 2.
        let valor1 = isNaN(parseFloat(matriz[filaIndex][1])) ? 0 : parseFloat(matriz[filaIndex][1]);
        let valor2 = isNaN(parseFloat(matriz[filaIndex][2])) ? 0 : parseFloat(matriz[filaIndex][2]);
        // * Se obtiene el total de la multiplicacion.
        let total = valor1 * valor2;
        // Le saginamos el valor al input de la columna 3.
        inputs[3].value = total;
        // * Se actualiza el valor del diccionario.
        matriz[filaIndex][3] = total;
        // * Llamar funcion para calcular el total de todos los apartados.
        calculaTotalBienesUtilidades(tipo, matriz);
        calcularDepreciacionMensual(matriz, filaIndex, inputs, tipo);
    }

    /**
     *  TODO: Funcion para calcular el total de depreciacion de 5 anios.
     * @param {*} matriz
     * @param {*} inputs
     * @param {*} filaIndex
     */
    function calcularDepreciacionCincoAnios(matriz, inputs, filaIndex) {
        let valor1 = isNaN(parseFloat(matriz[filaIndex][6])) ? 0 : parseFloat(matriz[filaIndex][6]);
        let valor2 = isNaN(parseFloat(matriz[filaIndex][7])) ? 0 : parseFloat(matriz[filaIndex][7]);
        let valor3 = isNaN(parseFloat(matriz[filaIndex][8])) ? 0 : parseFloat(matriz[filaIndex][8]);
        let valor4 = isNaN(parseFloat(matriz[filaIndex][9])) ? 0 : parseFloat(matriz[filaIndex][9]);
        let valor5 = isNaN(parseFloat(matriz[filaIndex][10])) ? 0 : parseFloat(matriz[filaIndex][10]);
        let total = (valor1 + valor2 + valor3 + valor4 + valor5).toFixed(2);
        inputs[11].value = total;
        matriz[filaIndex][11] = total;
    }


    /**
     *  TODO: Funcion para calcular la suma total de cada tipo.
     * @param {*} tipo
     * @param {*} matriz
     */
    function calculaTotalBienesUtilidades(tipo, matriz) {
        // * Se obtiene el th de la tabla.
        let th = document.querySelectorAll(`#${tipo} th`);
        // * variable que me sirve para calcular el total de bienes.
        let totalBienes = 0;
        // * Recorrer la matriz para obtener el total de bienes.
        for (let i = 0; i < matriz.length; i++) {
            // * Se obtiene el valor de la columna 3.
            totalBienes += isNaN(parseFloat(matriz[i][3])) ? 0 : parseFloat(matriz[i][3]);
        }
        // * Se asigna el valor al th de la tabla.
        th[1].textContent = totalBienes.toFixed(2);
    }

    /**
     *  TODO: Funcion para calcular el total de depreciacion mensual.
     *  @param {*} tipo
     *  @param {*} matriz
     */
    function calcularDepreciacionTotalMensual(tipo, matriz) {
        // * Se obtiene el th de la tabla.
        let th = document.querySelectorAll(`#${tipo} th`);
        // * variable que me sirve para calcular el total de bienes.
        let totalBienes = 0;
        // * Recorrer la matriz para obtener el total de bienes.
        for (let i = 0; i < matriz.length; i++) {
            // * Se obtiene el valor de la columna 3.
            totalBienes += isNaN(parseFloat(matriz[i][5])) ? 0 : parseFloat(matriz[i][5]);
        }
        // * Se asigna el valor al th de la tabla.
        th[3].textContent = totalBienes.toFixed(2);
    }


    /**
     *  TODO: Funcion para calcular el total por anio de depreciacion.
     * @param {*} tipo
     * @param {*} matriz
     * @param {*} posicionColumna
     */
    function calcularPorAnioDepreciacion(tipo, matriz, posicionColumna) {
        // * Se obtiene el th de la tabla.
        let th = document.querySelectorAll(`#${tipo} th`);
        // * variable que me sirve para calcular el total de bienes.
        let total = 0;
        // poner el primer for para recorrer las filas
        for (let i = 0; i < matriz.length; i++) {
            // variable para obtener el total de la columna
            total += isNaN(parseFloat(matriz[i][posicionColumna])) ? 0 : parseFloat(matriz[i][posicionColumna]);
        }
        // * Se asigna el valor al th de la tabla.
        th[posicionColumna - 2].textContent = total.toFixed(2);
        calcularDepreciacionTotalCincoAniosPorCadaAnio(tipo, matriz, 11);
    }// fin de la funcion calcularPorAnioDepreciacion

    /**
     *
     * @param {*} posicionColumna
     */
    function calcularLosFooterTotales(posicionColumna) {
        // * Variable que me obtendra todos la suma
        let total = 0;
        // obtener los tr de la tabla
        let trMobiliarios = document.querySelectorAll('#Total-mobiliario th');
        let trMaquinaria = document.querySelectorAll('#totales-maquinaria th');
        let trVehiculos = document.querySelectorAll('#total-vehiculos th');
        let trInmuebles = document.querySelectorAll('#total-bienes-inmuebles th');
        let thTotal = document.querySelectorAll('#total-bienes-muebles-e-inmuebles th');
        if (posicionColumna >= 1 && posicionColumna <= 2) {
            let valor1 = isNaN(parseFloat(trMobiliarios[1].textContent)) ? 0 : parseFloat(trMobiliarios[1].textContent);
            let valor2 = isNaN(parseFloat(trMaquinaria[1].textContent)) ? 0 : parseFloat(trMaquinaria[1].textContent);
            let valor3 = isNaN(parseFloat(trVehiculos[1].textContent)) ? 0 : parseFloat(trVehiculos[1].textContent);
            let valor4 = isNaN(parseFloat(trInmuebles[1].textContent)) ? 0 : parseFloat(trInmuebles[1].textContent);
            total = valor1 + valor2 + valor3 + valor4;
            thTotal[1].textContent = total.toFixed(2);
            total = 0;
            calcularFooterDepreciacionMensual(total, trMobiliarios, trMaquinaria, trVehiculos, trInmuebles, thTotal);
        } else if (posicionColumna === 4) {
            calcularFooterDepreciacionMensual(total, trMobiliarios, trMaquinaria, trVehiculos, trInmuebles, thTotal);
        } else {
            let valor1 = isNaN(parseFloat(trMobiliarios[posicionColumna - 2].textContent)) ? 0 : parseFloat(trMobiliarios[posicionColumna - 2].textContent);
            let valor2 = isNaN(parseFloat(trMaquinaria[posicionColumna - 2].textContent)) ? 0 : parseFloat(trMaquinaria[posicionColumna - 2].textContent);
            let valor3 = isNaN(parseFloat(trVehiculos[posicionColumna - 2].textContent)) ? 0 : parseFloat(trVehiculos[posicionColumna - 2].textContent);
            let valor4 = isNaN(parseFloat(trInmuebles[posicionColumna - 2].textContent)) ? 0 : parseFloat(trInmuebles[posicionColumna - 2].textContent);
            total = valor1 + valor2 + valor3 + valor4;
            thTotal[posicionColumna - 2].textContent = total.toFixed(2);
            calcularFooterCincoAnios(trMobiliarios, trMaquinaria, trVehiculos, trInmuebles, thTotal, 11);
        }
        // * Se asigna el valor al th de la tabla.
    }


    /**
     *  TODO: Funcion para calcular el footer de los 5 anios.
     * @param {*} trMobiliarios
     * @param {*} trMaquinaria
     * @param {*} trVehiculos
     * @param {*} trInmuebles
     * @param {*} thTotal
     * @param {*} posicionColumna
     */
    function calcularFooterCincoAnios(trMobiliarios, trMaquinaria, trVehiculos, trInmuebles, thTotal, posicionColumna) {
        let total = 0;
        let valor1 = isNaN(parseFloat(trMobiliarios[posicionColumna - 2].textContent)) ? 0 : parseFloat(trMobiliarios[posicionColumna - 2].textContent);
        let valor2 = isNaN(parseFloat(trMaquinaria[posicionColumna - 2].textContent)) ? 0 : parseFloat(trMaquinaria[posicionColumna - 2].textContent);
        let valor3 = isNaN(parseFloat(trVehiculos[posicionColumna - 2].textContent)) ? 0 : parseFloat(trVehiculos[posicionColumna - 2].textContent);
        let valor4 = isNaN(parseFloat(trInmuebles[posicionColumna - 2].textContent)) ? 0 : parseFloat(trInmuebles[posicionColumna - 2].textContent);
        total = valor1 + valor2 + valor3 + valor4;
        thTotal[posicionColumna - 2].textContent = total.toFixed(2);
    }

    
    /**
     *  TODO: Funcion para calcular el footer la depreciacion mensual FOOTER.
     * @param {*} total
     */
    function calcularFooterDepreciacionMensual(total, trMobiliarios, trMaquinaria, trVehiculos, trInmuebles, thTotal) {
        let valor1 = isNaN(parseFloat(trMobiliarios[3].textContent)) ? 0 : parseFloat(trMobiliarios[3].textContent);
        let valor2 = isNaN(parseFloat(trMaquinaria[3].textContent)) ? 0 : parseFloat(trMaquinaria[3].textContent);
        let valor3 = isNaN(parseFloat(trVehiculos[3].textContent)) ? 0 : parseFloat(trVehiculos[3].textContent);
        let valor4 = isNaN(parseFloat(trInmuebles[3].textContent)) ? 0 : parseFloat(trInmuebles[3].textContent);
        total = valor1 + valor2 + valor3 + valor4;
        thTotal[3].textContent = total.toFixed(2);
    }

});
