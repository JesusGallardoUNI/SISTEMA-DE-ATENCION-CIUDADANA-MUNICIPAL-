const Servicios_Generales = document.getElementById("reporte");





// 5️⃣ Función encargada SOLO de mostrar datos en HTML
//    NO sabe nada de fetch ni de la base de datos
function MostrarServicios(servicios) {

    // Obtenemos el contenedor donde se mostrarán los datos
    const contenedor = document.getElementById("OpcionesReportes");
    contenedor.innerHTML = "";
    

    // Recorremos el arreglo de colonias
    servicios.forEach(servicio => {

        
        

        // Creamos un elemento HTML <label>
        const Opcion = document.createElement("label");

        // Le pongo el for
        Opcion.setAttribute("for", servicio.problema);
        // Le pongo la clase
        Opcion.classList.add("ReporteOpcion");


        //CREO UN INPUT QUE QUEDE DENTRO DE LABEL
        const Input = document.createElement("input");
        Input.type = "radio";
        Input.id = servicio.problema;
        Input.name = "especificacion";
        Input.value = servicio.problema;
        Input.required = true;

        Opcion.appendChild(Input);

        Opcion.appendChild(document.createTextNode(` ${servicio.problema}`));

        


        // Agregamos el <p> dentro del contenedor
        contenedor.appendChild(Opcion);


    });
}

Servicios_Generales.addEventListener("change", function() {
    // 1️⃣ fetch hace una petición HTTP al endpoint (API en PHP)
    //    NO devuelve datos inmediatamente, devuelve una PROMESA
    alert(Servicios_Generales.value);
    
    fetch(`/GUADALUPE/Recursos/API/ApiServicios.php?Secretaria=${Servicios_Generales.value}`)

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
                MostrarServicios(data.servicios_lista);
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
});


