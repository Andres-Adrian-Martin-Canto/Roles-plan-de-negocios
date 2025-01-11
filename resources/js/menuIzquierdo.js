document.addEventListener("DOMContentLoaded", function () {
    let a = document.querySelectorAll("ol a");
    // Obtener el titulo de pagina
    let titulo = document.querySelector('title').innerText;
    // Condicion para saber en donde esta el usuario ubicado.
    if (titulo === "Gastos Preoperativos") {
        // remplace el color ring-gray-900 por ring-green-500
        a[2].querySelector('span').classList.replace('ring-gray-900', 'ring-green-500');
    }else if (titulo === "Total de Inversión Inicial") {
        a[1].querySelector('span').classList.replace('ring-gray-900', 'ring-green-500');
    }else if (titulo === "Gastos de articulos de venta") {
        a[4].querySelector('span').classList.replace('ring-gray-900', 'ring-green-500');
    }else if (titulo === "Gastos Mensuales") {
        a[3].querySelector('span').classList.replace('ring-gray-900', 'ring-green-500');
    }else{
        a[5].querySelector('span').classList.replace('ring-gray-900', 'ring-green-500');
    }


    // Asignarle el evento
    a.forEach((ae) => {
        // Se agregan los eventos.
        ae.onmouseenter = function () {
            ae.querySelector('span').classList.replace('bg-gray-700', 'bg-green-500');
            ae.querySelector('h3').classList.replace('text-gray-400', 'text-white');
            ae.querySelector('svg').classList.replace('text-gray-400', 'text-white');
        };

        ae.onmouseleave = function () {
            ae.querySelector('span').classList.replace('bg-green-500', 'bg-gray-700');
            ae.querySelector('h3').classList.replace('text-white', 'text-gray-400');
            ae.querySelector('svg').classList.replace('text-white', 'text-gray-400');
        };
    });
});
