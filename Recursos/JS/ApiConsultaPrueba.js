// 1️⃣ fetch hace una petición HTTP al endpoint (API en PHP)
//    NO devuelve datos inmediatamente, devuelve una PROMESA
fetch("/MUNICIPAL/Recursos/API/ApiPrueba.php")

    // 2️⃣ PRIMER then:
    //    response representa la RESPUESTA CRUDA del servidor
    //    aquí todavía NO son los datos finales
    .then(response => {

        // response.json():
        // - Lee el cuerpo de la respuesta
        // - Convierte el JSON (texto) a objeto JavaScript
        // - Devuelve OTRA promesa
        // ESTE return es el momento donde los datos
        // pasan de response → data
        return response.json();
    })

    // 3️⃣ SEGUNDO then:
    //    data ya es el JSON convertido a objeto JS
    //    aquí YA puedes usar success, listas, etc.
    .then(data => {

        // data.success viene directamente del JSON
        // que tú definiste en el endpoint PHP
        if (data.success) {

            // Enviamos solo la lista de colonias
            // para separar lógica de presentación
            mostrarColonias(data.colonias_lista);
        } else {
            // Si success = false, la API respondió
            // pero con un error lógico
            console.error("La API respondió con error");
        }
    })

    // 4️⃣ catch:
    //    SOLO se ejecuta si ocurre un error de conexión
    //    (servidor caído, archivo no existe, red, etc.)
    .catch(error => {
        //console.error("Error de conexión con la API:", error);
    });


// 5️⃣ Función encargada SOLO de mostrar datos en HTML
//    NO sabe nada de fetch ni de la base de datos
function mostrarColonias(colonias) {

    // Obtenemos el contenedor donde se mostrarán los datos
    const contenedor = document.getElementById("lista-colonias");

    // Recorremos el arreglo de colonias
    colonias.forEach(colonia => {

        // Creamos un elemento HTML <p>
        const p = document.createElement("p");

        // Insertamos el nombre de la colonia
        p.textContent = colonia.nombre_colonia;

        // Agregamos el <p> dentro del contenedor
        contenedor.appendChild(p);
    });
}