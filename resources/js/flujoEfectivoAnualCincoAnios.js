import { toastDiv, newToastDiv, newMessageP } from './mensajes.js';

document.addEventListener("DOMContentLoaded", function () {
    // * Obtengo el boton de guardar:
    const botonGuardar = document.getElementById('miBoton');
    // * Creacion de diccionarios
    let diccionarioGastosPreoperativos = {};
    let diccionarioGastos = {};
    let diccionarioGastoArticuloVenta = {};
    let diccionarioIngreso = {};
    // * Obtengo todos los bodys
    let bodys = document.querySelectorAll("table tbody");
    // TODO: Obtener los valores de la tabla
    obtenerLosDatos(bodys[0], diccionarioGastosPreoperativos);
    obtenerLosDatos(bodys[1], diccionarioGastos);
    obtenerLosDatos(bodys[2], diccionarioGastoArticuloVenta);
    obtenerLosDatos(bodys[3], diccionarioIngreso)
    // Obtengo la fila de resultados de gastosPreoperativos
    let filaResultado = document.getElementById("Total_Gastos_Preoperativos");
    let columnaResultado = filaResultado.children;
    /**
     *  TODO: LLamo a la función que agregara en la columna correspondiente la suma de la fila correspondiente.
     *  * Envió las columnas de la fila " resultado " correspondiente
     */
    asignaciónResultadoFila(columnaResultado, diccionarioGastosPreoperativos);
    // TODO: Calculando los resultados por columna de gastos
    filaResultado = document.getElementById("Total_gastos");
    columnaResultado = filaResultado.children;
    asignaciónResultadoFila(columnaResultado, diccionarioGastos);
    // TODO: Calculando los resultados de articulo de venta
    filaResultado = document.getElementById("Total_Gastos_articulos_venta");
    columnaResultado = filaResultado.children;
    asignaciónResultadoFila(columnaResultado, diccionarioGastoArticuloVenta);
    // TODO: Calculando los resultado de ingresos.
    filaResultado = document.getElementById("Total_ingresos");
    columnaResultado = filaResultado.children;
    asignaciónResultadoFila(columnaResultado, diccionarioIngreso);
    // Calcular resultados.
    resultadoUtilidades();


    /**
     *  TODO: Funcion para obtener los datos.
     * @param {*} tbody
     * @param {*} diccionario
     */
    function obtenerLosDatos(tbody, diccionario) {
        // Obtengo todas las filas
        let filas = tbody.querySelectorAll("tr");
        // For
        filas.forEach(function (fila) {
            // Obtengo a cual id pertenece.
            let id_pertenece = fila.querySelector('td[id_pertenece]').getAttribute('id_pertenece');
            // Obtengo todas las columnas.
            let columnas = fila.querySelectorAll('td');
            // Creamos un diccionario
            diccionario[id_pertenece] = [];
            for (let index = 1; index < columnas.length; index++) {
                // Obtengo el input de la celda.
                let input = columnas[index].querySelector('input');
                // * Creacion de evento para el input
                agregarEventInputs(input);
                // obtenemos el id al cual pertence
                let id_actual = columnas[index].getAttribute('id_actual');
                // * Se lo asignamos al diccionario
                diccionario[id_pertenece].push([id_actual, parseFloat(input.value)]);
            } // Fin del for
        }); // Fin del forEach
    } // Fin de la funcion.


    /**
     *  TODO: Creacion de
     * @param {*} input
     */
    function agregarEventInputs(input) {
        input.addEventListener("blur", function () {
            // Obtenemos el body.
            let parentTbody = input.closest('tbody');
            // Saber cual body es
            let bodyEs = parentTbody.getAttribute('id');
            // Obtener la columna de la tabla
            let columnaTd = input.closest('td');
            // Obtener la fila de la tabla
            let filaTr = columnaTd.closest('tr');
            // Obtener la posición del input que se dejo de escribir.
            let columnaPosición = columnaTd.cellIndex;
            // Obtener a cual pertenece
            let id_pertenece = filaTr.querySelector('td[id_pertenece]').getAttribute('id_pertenece')
            // Variable para saber cual diccionario se va a usar.
            let diccionario;
            // Variable para saber cual fila es.
            let filaResultado;
            // If para saber cual diccionario usaremos.
            if (bodyEs === "gastos_preoperativos") {
                diccionario = diccionarioGastosPreoperativos;
                // Obtenemos la fila de resultado correspondiente.
                filaResultado = document.getElementById("Total_Gastos_Preoperativos");
            } else if (bodyEs === "gastos") {
                diccionario = diccionarioGastos;
                // Obtenemos la fila de resultado correspondiente.
                filaResultado = document.getElementById("Total_gastos");
            } else if (bodyEs === "Gastos_articulos_venta") {
                diccionario = diccionarioGastoArticuloVenta;
                // Obtenemos la fila de resultado correspondiente.
                filaResultado = document.getElementById("Total_Gastos_articulos_venta");
            } else if (bodyEs === "ingresos") {
                diccionario = diccionarioIngreso;
                // Obtenemos la fila de resultado correspondiente.
                filaResultado = document.getElementById("Total_ingresos");
            }
            // Obtengo las columnas de la fila de resultado correspondiente
            columnaResultado = filaResultado.children;
            if (input.value.trim()) {
                // Creación de expresión regular.
                let regex = /^[-+]?\d*\.?\d+$/;
                // Si cumple con un valor decimal manda hacer lo demás
                if (regex.test(input.value)) {
                    if (input.value != diccionario[id_pertenece][columnaPosición - 1][1]) {
                        // Llamar para activar boton.
                        activarButton();
                        // * Le asignamos el valor del input.
                        diccionario[id_pertenece][columnaPosición - 1][1] = parseFloat(input.value);
                        // Llamamos para que calcule la fila de resultado correspondiente.
                        asignaciónResultadoFila(columnaResultado, diccionario);
                        // Llamamos función para que calcula las utilidades.
                        resultadoUtilidades();
                    }
                    // De lo contrario mandar error.
                } else {
                    activarButton();
                    // Le asignamos el valor 0
                    input.value = 0;
                    // Le asignamos el valor 0
                    diccionario[id_pertenece][columnaPosición - 1][1] = 0;
                    // Llamamos para que calcule la fila de resultado correspondiente.
                    asignaciónResultadoFila(columnaResultado, diccionario);
                    // Llamamos función para que calcula las utilidades.
                    resultadoUtilidades();
                    newMessageP.textContent = "Solo se permiten números enteros o decimales.";
                    newToastDiv.style.display = 'block';
                }
                // De lo contrario pondrá un cero al input
            } else {
                activarButton();
                // Le asignamos el valor 0
                input.value = 0;
                // Le asignamos el valor 0
                diccionario[id_pertenece][columnaPosición - 1][1] = 0;
                // Llamamos para que calcule la fila de resultado correspondiente.
                asignaciónResultadoFila(columnaResultado, diccionario);
                // Llamamos función para que calcula las utilidades.
                resultadoUtilidades();
                newMessageP.textContent = "No se permiten espacios y no dejar celda vacía";
                newToastDiv.style.display = 'block';
            } // Fin de la condiciones
        });
    } // Fin de la funcion


    function resultadoUtilidades() {
        // Footer de cada parte
        let f_resultado_gastos_preoperativos = document.getElementById('Total_Gastos_Preoperativos').children;
        let f_resultado_gastos = document.getElementById("Total_gastos").children;
        let f_resultado_gastos_venta = document.getElementById("Total_Gastos_articulos_venta").children;
        let f_resultado_ingresos = document.getElementById("Total_ingresos").children;
        // * Footer de utilidades
        let f_utilidades = document.getElementById("utilidades").children;
        for (let index = 1; index < f_utilidades.length; index++) {
            let vGastosPreoperativos = f_resultado_gastos_preoperativos[index].textContent.substring(1);
            let vGastos = f_resultado_gastos[index].textContent.substring(1);
            let vGastosVenta = f_resultado_gastos_venta[index].textContent.substring(1);
            let vIngreso = f_resultado_ingresos[index].textContent.substring(1);
            // * Asignacion en la columna correspondiente
            f_utilidades[index].innerHTML = "$" + (parseFloat(vIngreso) - (parseFloat(vGastosPreoperativos) + parseFloat(vGastos) + parseFloat(vGastosVenta))).toFixed(2);
        } // FIN DEL FOR
    } // FIN DE LA FUNCION


    /**
     * TODO: Activar boton.
     */
    function activarButton() {
        if (botonGuardar.disabled) {
            botonGuardar.classList.replace('bg-green-800', 'bg-green-500');
            botonGuardar.classList.toggle
            botonGuardar.classList.replace('text-gray-400', 'text-white');
            botonGuardar.disabled = false;
        }
    }

    /**
     *  TODO: Función que asignara los valores en cada columna de la fila de resultado
     * @param {*} columnasFila
     * @param {*} estructuraBody
     */
    function asignaciónResultadoFila(columnasFila, estructuraBody) {
        // Obtengo las llaves del diccionario
        let claves = Object.keys(estructuraBody);
        // Recorro 5 veces por los cinco años que son.
        for (let indexColumna = 0; indexColumna < columnasFila.length - 1; indexColumna++) {
            // Creo una variable el cual obtendrá la suma total del resultado
            let sumaResultado = 0;
            // For que recorre por filas
            for (let index = 0; index < claves.length; index++) {
                // Hace la sumatoria de la columna correspondiente
                sumaResultado += estructuraBody[claves[index]][indexColumna][1];
            }   // Fin del for filas.
            // Escribe el valor de la columna correspondiente
            columnasFila[indexColumna + 1].innerHTML = '$' + sumaResultado.toFixed(2);
        } // Fin del for de columnas.
    } // Fin de la función asignar valores en la fila resultado


    /**
     *  TODO: Evento del boton guardar
     */
    botonGuardar.addEventListener('click', function () {
        let objeto = [diccionarioGastosPreoperativos, diccionarioGastos, diccionarioGastoArticuloVenta, diccionarioIngreso];
        fetch(this.getAttribute("urlDinamica"), {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify(objeto)
        }).then(response => {
            if (response.ok) {
                toastDiv.style.display = 'block';
            } else {
                throw new Error("Error en la solicitud");
            }
        }).catch(error => {
            console.error("error: ", error);
        })
    });
});
