//======================================================================================//
//  Al darle clic a cualquiera de las opciones del div que se encuentran dentro del nav //
//======================================================================================//

document.addEventListener("DOMContentLoaded", function () {
    // Aquí se declaran los botones
    const opcion1 = document.getElementById("Opcion1");
    const opcion2 = document.getElementById("Opcion2");
    const opcion3 = document.getElementById("Opcion3");
    const opcion4 = document.getElementById("Opcion4");
    const opcion5 = document.getElementById("Opcion5");
    const opcion6 = document.getElementById("Opcion6");
    const opcion7 = document.getElementById("Opcion7");
    const opcion8 = document.getElementById("Opcion8");

    // Aquí se declara la problemática particular
    const problematica = document.getElementById("Problematica");

    // Cargar texto guardado, si existe
    const textoGuardado = localStorage.getItem("problematicaTexto");
    if (textoGuardado) {
        problematica.innerText = textoGuardado;
    }

    // Función para cambiar texto y guardarlo
    function cambiarTexto(nuevoTexto) {
        problematica.innerText = nuevoTexto;
        localStorage.setItem("problematicaTexto", nuevoTexto);
    }

    opcion1.addEventListener("click", function () {
        cambiarTexto("Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales");
    });

    opcion2.addEventListener("click", function () {
        cambiarTexto("Alumbrado público");
    });

    opcion3.addEventListener("click", function () {
        cambiarTexto("Limpia, recolección, traslado, tratamiento y disposición final de residuos");
    });

    opcion4.addEventListener("click", function () {
        cambiarTexto("Mercados y centrales de abasto");
    });

    opcion5.addEventListener("click", function () {
        cambiarTexto("Panteones");
    });

    opcion6.addEventListener("click", function () {
        cambiarTexto("Rastro");
    });

    opcion7.addEventListener("click", function () {
        cambiarTexto("Calles, parques y jardines y su equipamiento");
    });

    opcion8.addEventListener("click", function () {
        cambiarTexto("Seguridad pública, policía preventiva municipal y tránsito");
    });
});
