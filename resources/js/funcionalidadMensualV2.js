/**
 * Autor: Andres Adrian Martin Canto
 * Version: 1.0
 * description:
 */
// * Importamos los botones asi como los divs de los mensajes de error y que se guardo correctamente.
import { toastDiv, newToastDiv, newMessageP, botonCerrar, divMensaje } from './mensajes.js';
// * Variable que tendra la matriz
var matrizMultidimensional = [];
var regex = /^[-+]?\d*\.?\d+$/;

document.addEventListener("DOMContentLoaded", function () {
    // * Obtener el boton de guardar para crear su evento despues.
    const miBoton = document.getElementById("miBoton");
    // * Obtener las filas de la tabla
    let filas = document.querySelectorAll("table tbody tr");
    // * Recoorrer todas las filas para obtener los valores.
    filas.forEach(function (fila) {
        // * Obtener los inputs de la fila
        let inputs = fila.querySelectorAll("input");
        // * Crear un arreglo el cual me va a servir para meterlo en la matriz.
        let arrayValores = [];
        inputs.forEach(function (input) {
            // * Asigno el evento al input.
            eventoInputs(input);
            // * Almacenar el valor en la array de valores.
            arrayValores.push(input.value);
        });
        // * Agregar el array de valores a la matriz.
        matrizMultidimensional.push(arrayValores);
    }); // * Fin del foreach de recorrer las filas.
    // Llamo funcion para calcular el total.
    calcularTotalDeTotales();
    // TODO: Crear los eventos para los botones de los datos de la base de datos
    let botones = document.querySelectorAll("table tbody tr button");
    // Recorro los botones para asignarle el evento.
    botones.forEach((boton) => {
        // Se agregan los eventos.
        eventoBoton(boton);
    });


    /**
     * TODO: Evento
     */
    miBoton.onclick = async function () {
        // Copio la matriz
        let copiaMatriz = matrizMultidimensional.slice();
        // Creo una variable para obtener la respuesta de si desea confirmar.
        let result = true;
        // Pregunto si existen otros datos en los anuales.
        if (miBoton.getAttribute('informacion')) {
            // Mando a preguntar si quiere confirmar y se borren los datos de la tabla para los anuales o cinco anios.
            result = await customConfirm('Tienes información en las tablas anuales. Si aceptas, se van a borrar los datos anuales.');
        }
        // * Si la respuesta fue si entonces entra
        if (result) {
            // Si la matriz no tiene una celda vacia entonces entra hacer la peticion.
            if (validarMatriz(copiaMatriz)) {
                // Obtengo la ruta.
                let ruta = this.getAttribute("urlDinamica");
                fetch(ruta, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    },
                    body: JSON.stringify(copiaMatriz),
                }).then(Response => {
                    if (Response.ok) {
                        toastDiv.style.display = 'block';
                    } else {
                        throw new Error("Error en la solicitud");
                    }
                });
            } else {
                // Agregar el texto de la moda.
                newMessageP.textContent = "Tienes datos vacíos en una fila.";
                // Mostrar el moda.
                newToastDiv.style.display = 'block';
            }
        }
    }

    /**
     *  TODO: Funcion para crear el moda.
     */
    async function customConfirm(message) {
        return new Promise(resolve => {
            const confirmDialog = document.createElement('div');
            confirmDialog.innerHTML = `
            <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Datos anuales
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm leading-5 text-gray-500">
                                    ${message}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex justify-center sm:flex-row-reverse gap-2">
                        <span class="flex w-full mt-3 rounded-md shadow-sm sm:w-auto">
                            <button id="confirmBtn" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Aceptar
                            </button>
                        </span>
                        <span class="flex w-full mt-3 rounded-md shadow-sm sm:w-auto">
                            <button id="cancelBtn" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancelar
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    `;
            document.body.appendChild(confirmDialog);

            document.getElementById('confirmBtn').addEventListener('click', () => {
                document.body.removeChild(confirmDialog);
                resolve(true);
            });

            document.getElementById('cancelBtn').addEventListener('click', () => {
                document.body.removeChild(confirmDialog);
                resolve(false);
            });
        });
    }


    /**
     *  TODO: Funcion para validar que ninguna celda este vacia.
     * @param {*} copiaMatriz
     */
    function validarMatriz(copiaMatriz) {
        if (copiaMatriz.length > 1) {
            copiaMatriz.pop();
            for (let fila = copiaMatriz.length - 1; fila >= 0; fila--) {
                if (copiaMatriz[fila].every(elemento => elemento === "")) {
                    copiaMatriz.splice(fila, 1); // Elimina la fila vacía
                }
            }

            // Recorremos cada fila de la matriz
            for (let fila of copiaMatriz) {
                let contadorDatos = 0;
                // Contamos cuántas celdas tienen datos en cada fila
                for (let celda of fila) {
                    if (celda !== '') {
                        contadorDatos++;
                    }
                }
                // Valida que la fila tenga todos los valores.
                if (contadorDatos < copiaMatriz[0].length) {
                    return false;
                }
            }
            // Si llegamos aquí, significa que todas las filas pasaron la validación
            return true;
        } else {
            // Recorremos cada fila de la matriz
            for (let fila of copiaMatriz) {
                let contadorDatos = 0;
                // Contamos cuántas celdas tienen datos en cada fila
                for (let celda of fila) {
                    if (celda !== '') {
                        contadorDatos++;
                    }
                }
                // Valida que la fila tenga todos los valores.
                if (contadorDatos > 0) {
                    return false;
                }
            }
            return true;
        }
    }


    /**
     *  TODO: Funcion para asignarle el evento.
     * @param {*} input
     */
    function eventoInputs(input) {
        // * Asignandole el evento.
        input.addEventListener("blur", function () {
            // * Obtener el padre
            const tdPadre = input.parentElement;
            // * Obtengo la posicion de la fila
            let posicionFila = tdPadre.parentNode.rowIndex;
            // * Obtengo la posicion de la columna.
            let posicionColumna = tdPadre.cellIndex;
            if (posicionColumna > 0) {
                // * Validar que no tenga espacios
                if (input.value.trim()) {
                    // * Valida la expresion regular que solo permite numeros decimales.
                    if (regex.test(input.value)) {
                        // * Validar que sea diferente el valor del input con el de la matriz.
                        if (input.value != matrizMultidimensional[posicionFila - 1][posicionColumna]) {
                            // * Borrar los espacios y asignarselos
                            input.value = input.value.trim();
                            // Llamar a funcion para activar boton.
                            activarBoton();
                            // Despues agrego el valor del input a la matriz.
                            matrizMultidimensional[posicionFila - 1][posicionColumna] = input.value;
                            // If si no es el input de la segunda celda entonces entrara al obtenerTdAnterior.
                            posicionColumna == 1 ? obtenerTdSiguiente(tdPadre, posicionFila, posicionColumna, input) : obtenerTdAnterior(tdPadre, posicionFila, posicionColumna, input);
                        }
                        // * Si tiene espacios entonces marca un error y le cambio el valor del input.
                    } else {
                        // * Cambiar el valor del input actual.
                        input.value = "0";
                        // * Cambiar el valor igual en la matriz.
                        matrizMultidimensional[posicionFila - 1][posicionColumna] = "0";
                        // If si no es el input de la segunda celda entonces entrara al obtenerTdAnterior.
                        posicionColumna == 1 ? obtenerTdSiguiente(tdPadre, posicionFila, posicionColumna, input) : obtenerTdAnterior(tdPadre, posicionFila, posicionColumna, input);
                        // Llamar a funcion para activar boton.
                        activarBoton();
                        // Asignarle el nombre al errror.
                        newMessageP.textContent = "Solo se permiten números en este campo.";
                        // Activar el mensaje.
                        newToastDiv.style.display = 'block';
                    }
                }
            } else { // * En este caso es para el input donde va el texto.
                // Si es diferente de lo que ya estaba entra.
                if (input.value != matrizMultidimensional[posicionFila - 1][posicionColumna]) {
                    // Borrar los espacios y asignarselo al input
                    input.value = input.value.trim();
                    // Llamada a la funcion activar boton.
                    activarBoton();
                    // Le asigno a la matriz igual el valor
                    matrizMultidimensional[posicionFila - 1][posicionColumna] = input.value.trim();
                    // Verificamos si se puede crear una nueva fila.
                    crearFila(posicionFila, tdPadre);
                }
            }
        });
    }



    /**
     * TODO: Funcion para activar el boton de guardado.
     */
    function activarBoton() {
        // * Si el boton esta deshabilitado entonces hara lo siguiente.
        if (miBoton.disabled) {
            // Replaza el fondo por otro.
            miBoton.classList.replace('bg-green-800', 'bg-green-500');
            // Replaza el color del texto.
            miBoton.classList.replace('text-gray-400', 'text-white');
            // Activa el boton.
            miBoton.disabled = false;
        }
    }



    /**
     *  TODO: Evento para obtener el valor del input del td siguiente.
     * @param {*} tdpadre
     * @param {*} posicionFila
     * @param {*} posicionColumna
     * @param {*} input
     */
    function obtenerTdSiguiente(tdpadre, posicionFila, posicionColumna, input) {
        // Obtengo el td siguiente
        const tdSiguiente = tdpadre.nextElementSibling;
        // obtengo el td total.
        const tdTotal = tdSiguiente.nextElementSibling;
        // * En caso que tenga valor hara le calculo.
        if (tdSiguiente.querySelector("input").value) {
            // Calculo el input actual con el input siguiente.
            let calcularTotal = parseFloat(input.value) * parseFloat(tdSiguiente.querySelector("input").value);
            // * Asigno el resultado de la multiplicacion a la matriz
            matrizMultidimensional[posicionFila - 1][posicionColumna + 2] = calcularTotal.toFixed(2).toString();
            // * Asigno el resultado de la multiplicacion al td total.
            tdTotal.querySelector("input").value = calcularTotal.toFixed(2).toString();
            // Se manda a calcular el total de los totales.
            calcularTotalDeTotales();
            // Llamar a metodo para ver si se tiene que crear nueva fila.
            crearFila(posicionFila, tdpadre);
        } else { // * En caso de que la fila este vacia asignara en el td total el valor 0
            tdTotal.querySelector("input").value = "0.00";
            // Se le asigna igual a la matriz.
            matrizMultidimensional[posicionFila - 1][posicionColumna + 2] = "0.00";
            // Se manda a calcular el total de los totales.
            calcularTotalDeTotales();
        }
    }



    /**
     *  TODO: Funcion para obtener el td anterior.
     * @param {*} tdpadre
     * @param {*} posicionFila
     * @param {*} posicionColumna
     * @param {*} input
     */
    function obtenerTdAnterior(tdpadre, posicionFila, posicionColumna, input) {
        // Obtengo el td anterior.
        const tdAnterior = tdpadre.previousElementSibling;
        // Obtengo el td total de la fila
        const tdTotal = tdpadre.nextElementSibling;
        if (tdAnterior.querySelector("input").value) {
            // Calculo el input actual con el input anterior.
            let calcularTotal = parseFloat(input.value) * parseFloat(tdAnterior.querySelector("input").value);
            // * Asigno el resultado de la multiplicacion a la matriz
            matrizMultidimensional[posicionFila - 1][posicionColumna + 1] = calcularTotal.toFixed(2).toString();
            // * Asigno el resultado de la multiplicacion al td total.
            tdTotal.querySelector("input").value = calcularTotal.toFixed(2).toString();
            // Se manda a calcular el total de los totales.
            calcularTotalDeTotales();
            // Llamar a metodo para ver si se tiene que crear nueva fila.
            crearFila(posicionFila, tdpadre);
        } else {
            // * En caso de que la fila este vacia asignara en el td total el valor 0
            tdTotal.querySelector("input").value = "0.00";
            // Se le asigna igual a la matriz.
            matrizMultidimensional[posicionFila - 1][posicionColumna + 1] = "0.00";
            // Se manda a calcular el total de los totales.
            calcularTotalDeTotales();
        }
    }




    /**
     *  TODO: Funcion para calcular el total de cada fila y eso me obtendra el total de toda la tabla.
     */
    function calcularTotalDeTotales() {
        // Variable para calcular el total.
        let totalDeTotales = 0;
        // Recorrer la posicion ultima.
        for (let index = 0; index < matrizMultidimensional.length; index++) {
            // Obtengo la ultima columna de la matriz.
            if (matrizMultidimensional[index][matrizMultidimensional[index].length - 1] !== "") {
                // Calculo el valor.
                totalDeTotales += parseFloat(matrizMultidimensional[index][matrizMultidimensional[index].length - 1]);
            }
        }
        // * obtengo el total de todas las fila
        let filaTotalDeTotales = document.getElementById("totaldeTotales");
        // Asignarle el resultado al footer de la tabla.
        filaTotalDeTotales.innerText = filaTotalDeTotales.innerText.split('$')[0] + " $" + totalDeTotales.toFixed(2).toString();
    }




    /**
     *  TODO: Metodo para comprobar si se debe crear una nueva fila.
     * @param {*} posicionFila
     * @param {*} tdpadre
     */
    function crearFila(posicionFila, tdpadre) {
        // * Saber si es la ultima fila.
        if (posicionFila === matrizMultidimensional.length) {
            // Para comprobar si en la fila no hay vacios
            if (matrizMultidimensional[posicionFila - 1][0].trim() &&
                matrizMultidimensional[posicionFila - 1][1].trim() &&
                matrizMultidimensional[posicionFila - 1][2].trim()) {
                // * Asignarle un nuevo array a la matriz
                matrizMultidimensional.push(new Array(4).fill(""));
                // Crear un boton para eliminar la fila.
                const botonEliminar = document.createElement("button")
                // Asignando un texto.
                botonEliminar.textContent = "Eliminar";
                // Asignando las clases para el css
                botonEliminar.classList.add(
                    "bg-red-500",
                    "hover:bg-red-700",
                    "text-white",
                    "font-bold",
                    "py-2",
                    "px-4",
                    "rounded",
                    "w-full"
                );
                // Asignancion de evento del boton.
                eventoBoton(botonEliminar);
                // Agregamos el boton a la fila.
                tdpadre.parentElement.insertCell(-1).appendChild(botonEliminar);
                // Obtener el tdbody de la tabla para crear la fila.
                let tbody = tdpadre.parentElement.parentElement;
                // Creo una fila.
                let nuevaFila = tbody.insertRow();
                // For para crear las 4 columnas de la fila nueva.
                for (let n = 0; n < 4; n++) {
                    // Creacion de celda
                    let celda = nuevaFila.insertCell();
                    // Agregamos las clases.
                    celda.classList.add("border", "px-4", "py-2");
                    // Creamos el input.
                    let inputNuevo = document.createElement("input")
                    // Asignacion de atributos.
                    inputNuevo.setAttribute("type", "text");
                    // Asignacion al input ultimo para que este deshabilitado
                    if (n === 3) {
                        inputNuevo.setAttribute("disabled", "true");
                    }
                    // Le asigno el evento al input.
                    eventoInputs(inputNuevo);
                    n > 0 ? inputNuevo.classList.add("w-full", "border", "rounded-sm", "px-2", "py-1", "text-right") : inputNuevo.classList.add("w-full", "border", "rounded-sm", "px-2", "py-1", "text-left");
                    // Agregar el input a la celda
                    celda.appendChild(inputNuevo);
                }
            }
        }
    }




    /**
     *  TODO: Evento del boton.
     * @param {*} button
     */
    function eventoBoton(button) {
        // Asignancion del eventon click
        button.addEventListener('click', function () {
            // Obtengo la posicion de donde se dio clic al boton
            const posicionFila = button.parentNode.parentNode.rowIndex;
            // Activo boton para guardar.
            activarBoton();
            // Obtengo la tabla
            const tabla = document.querySelector("table");
            // Quitar la fila de la matriz.
            matrizMultidimensional.splice(posicionFila - 1, 1);

            // Eliminar la fila de la tabla.
            tabla.deleteRow(posicionFila);
            //  Recalcular el total de los totales
            calcularTotalDeTotales();
        });
    }
}); // * Fin del metodo DOMContentLoaded
