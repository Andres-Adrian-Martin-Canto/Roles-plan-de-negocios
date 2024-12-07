import { toastDiv, newToastDiv, newMessageP, botonCerrar, divMensaje } from './mensajes.js';
document.addEventListener('DOMContentLoaded', function () {
    let inputs = document.querySelectorAll('table input');
    var botonGuardar = document.getElementById('miBoton');
    var capitalDelTrabajo = 0;
    var prestamo = 0;
    // Obtener los valores de los inputs
    obtenerValores(inputs);


    /**
     *  TODO: Funcion para obtener los valores de los inputs
     * @param {*} inputs
     */
    function obtenerValores(inputs) {
        capitalDelTrabajo = parseFloat(inputs[0].value).toFixed(2);
        prestamo = parseFloat(inputs[1].value).toFixed(2);
    }

    inputs.forEach(input => {
        input.addEventListener('change', function () {
            const regex = /^[-+]?\d*\.?\d+$/;
            let fila = input.parentElement.parentElement;
            // como saber cual indice de fila es
            let indice = Array.from(fila.parentElement.children).indexOf(fila);
            // Saber la fila en la que se encuentra el input
            if (regex.test(input.value)) {
                activarBoton();
                if (indice === 0) {
                    capitalDelTrabajo = parseFloat(input.value);
                    // buscar los demas td para hacer el calculo.
                    let inputPrestamo = parseFloat(document.getElementById('prestamo').value);
                    let tdmobiliario = parseFloat(document.getElementById('mobiliario').textContent);
                    let tdmaquinaria = parseFloat(document.getElementById('maquinaria').textContent);
                    let tdvehiculo = parseFloat(document.getElementById('vehiculos').textContent);
                    let tdbienes_inmuebles = parseFloat(document.getElementById('bienes_inmuebles').textContent);
                    let tdgastos_operativos = parseFloat(document.getElementById('gastos_operativos').textContent);

                    let tdcapitalContable = document.getElementById('capitalContable');

                    let resultado = (tdmobiliario + tdmaquinaria + tdvehiculo + tdbienes_inmuebles + tdgastos_operativos + capitalDelTrabajo) - inputPrestamo;
                    tdcapitalContable.textContent = resultado.toFixed(2);
                } else {
                    prestamo = parseFloat(input.value).toFixed(2);
                    // buscar los demas td para hacer el calculo.
                    let inputCapital = parseFloat(document.getElementById('capital_trabajo').value);
                    let tdmobiliario = parseFloat(document.getElementById('mobiliario').textContent);
                    let tdmaquinaria = parseFloat(document.getElementById('maquinaria').textContent);
                    let tdvehiculo = parseFloat(document.getElementById('vehiculos').textContent);
                    let tdbienes_inmuebles = parseFloat(document.getElementById('bienes_inmuebles').textContent);
                    let tdgastos_operativos = parseFloat(document.getElementById('gastos_operativos').textContent);
                    let tdcapitalContable = document.getElementById('capitalContable');
                    let resultado = (tdmobiliario + tdmaquinaria + tdvehiculo + tdbienes_inmuebles + tdgastos_operativos + inputCapital) - prestamo;
                    tdcapitalContable.textContent = resultado.toFixed(2);
                }
            } else {
                input.value = 0;
                activarBoton();
                if (indice === 0) {
                    capitalDelTrabajo = parseFloat(input.value).toFixed(2);
                    // buscar los demas td para hacer el calculo.
                    let inputPrestamo = parseFloat(document.getElementById('prestamo').value);
                    let tdmobiliario = parseFloat(document.getElementById('mobiliario').textContent);
                    let tdmaquinaria = parseFloat(document.getElementById('maquinaria').textContent);
                    let tdvehiculo = parseFloat(document.getElementById('vehiculos').textContent);
                    let tdbienes_inmuebles = parseFloat(document.getElementById('bienes_inmuebles').textContent);
                    let tdgastos_operativos = parseFloat(document.getElementById('gastos_operativos').textContent);
                    let tdcapitalContable = document.getElementById('capitalContable');
                    let resultado = (tdmobiliario + tdmaquinaria + tdvehiculo + tdbienes_inmuebles + tdgastos_operativos + capitalDelTrabajo) - inputPrestamo;
                    tdcapitalContable.textContent = resultado.toFixed(2);
                } else {
                    prestamo = parseFloat(input.value).toFixed(2);
                    // buscar los demas td para hacer el calculo.
                    let inputCapital = parseFloat(document.getElementById('capital_trabajo').value);
                    let tdmobiliario = parseFloat(document.getElementById('mobiliario').textContent);
                    let tdmaquinaria = parseFloat(document.getElementById('maquinaria').textContent);
                    let tdvehiculo = parseFloat(document.getElementById('vehiculos').textContent);
                    let tdbienes_inmuebles = parseFloat(document.getElementById('bienes_inmuebles').textContent);
                    let tdgastos_operativos = parseFloat(document.getElementById('gastos_operativos').textContent);
                    let tdcapitalContable = document.getElementById('capitalContable');
                    let resultado = (tdmobiliario + tdmaquinaria + tdvehiculo + tdbienes_inmuebles + tdgastos_operativos + inputCapital) - prestamo;
                    tdcapitalContable.textContent = resultado.toFixed(2);
                }
                // Cambiar el mensaje
                newMessageP.textContent = "Solo se permiten números en este campo.";
                // Activar el mensaje.
                newToastDiv.style.display = 'block';
            }
        }); // fin del evento
    }); // fin del forEach


    /**
     * TODO: Funcion para activar el boton de guardar
     */
    function activarBoton() {
        // * Si el boton esta deshabilitado entonces hara lo siguiente.
        if (botonGuardar.disabled) {
            // Replaza el fondo por otro.
            botonGuardar.classList.replace('bg-green-800', 'bg-green-500');
            // Replaza el color del texto.
            botonGuardar.classList.replace('text-gray-400', 'text-white');
            // Activa el boton.
            botonGuardar.disabled = false;
        }
    }


    // * Evento para el boton de guardar
    botonGuardar.addEventListener('click', function () {
        // * Obtenemos la rua
        let ruta = this.getAttribute("urlDinamica");
        fetch(ruta, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            // * Enviar la matriz en formato JSON
            body: JSON.stringify([capitalDelTrabajo, prestamo]),
        }).then(Response => {
            if (Response.ok) {
                toastDiv.style.display = 'block';
            } else {
                throw new Error("Error en la solicitud");
            }
        });
    });
});
